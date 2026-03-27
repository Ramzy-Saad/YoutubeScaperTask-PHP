<?php

namespace App\Http\Controllers;

use App\Services\AiService;
use App\Services\PlaylistService;
use App\Services\YouTubeService;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FetchController extends Controller
{
    public function index(Request $request)
    {
        $query = Playlist::query();

        if ($request->category && $request->category != 'all') {
            $query->where('category', $request->category);
        }
        $playlists = $query->latest()->paginate(12)->withQueryString();

        $categories = Playlist::select('category')->distinct()->pluck('category');

        return view('index', compact('playlists', 'categories'));
    }

    public function fetch(Request $request, AiService $ai, YouTubeService $yt, PlaylistService $ps)
    {
        $categories = explode("\n", $request->categories);
        
        foreach ($categories as $category) {
            $category = trim($category);
            if (!$category) continue;
            
            $titles = $ai->generateTitles($category);

            foreach ($titles as $title) {
                $title = preg_replace('/^\d+\.\s*/', '', $title);

                $results = $yt->search($title);
                foreach ($results as $item) {
                    $playlistIds = array_map(fn($item) => $item['id']['playlistId'], $results);
                    $detailsResponse = Http::get('https://www.googleapis.com/youtube/v3/playlists', [
                        'part' => 'contentDetails',
                        'id' => implode(',', $playlistIds), // up to 50 IDs per request
                        'key' => env('YOUTUBE_API_KEY'),
                    ]);

                    $detailsData = $detailsResponse->json()['items'] ?? [];
                    $playlistId = $item['id']['playlistId'];
                    $detail = collect($detailsData)->firstWhere('id', $playlistId);
                    $lessonCount = $detail['contentDetails']['itemCount'] ?? 1;
                    $ps->store($item, $category, $lessonCount);
                }
            }
        }

        return back()->with('success', 'Done');
    }
}
