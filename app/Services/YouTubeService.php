<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class YouTubeService
{
    public function search($query)
    {
        return Http::get('https://www.googleapis.com/youtube/v3/search', [
            'part' => 'snippet',
            'q' => $query,
            'type' => 'playlist',
            'maxResults' => 2,
            'key' => env('YOUTUBE_API_KEY'),
        ])['items'] ?? [];
    }
}