<?php

namespace App\Services;
use App\Models\Playlist;
use Illuminate\Support\Facades\Http;


class PlaylistService
{
    public function store($item, $category,$lessonCount)
    {
        Playlist::updateOrCreate(
            ['playlist_id' => $item['id']['playlistId']],
            [
                'title' => $item['snippet']['title'],
                'description' => $item['snippet']['description'],
                'thumbnail' => $item['snippet']['thumbnails']['high']['url'] ?? null,
                'channel_name' => $item['snippet']['channelTitle'],
                'category' => $category,
                'lessons_count' => $lessonCount,
            ]
        );
    }
}