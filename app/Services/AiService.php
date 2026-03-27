<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiService
{
    // // that for real titles which need for payemnt in openAi
    //public function generateTitles($category)
    //{
    //    $response = Http::withToken(env('OPENAI_API_KEY'))
    //        ->retry(3, 2000) // retry 3 times, wait 2s
    //        ->post('https://api.openai.com/v1/chat/completions', [
    //            'model' => 'gpt-4o-mini',
    //            'messages' => [
    //                [
    //                    'role' => 'user',
    //                    'content' => "Generate 10 YouTube course titles for $category as a clean list only"
    //                ]
    //            ]
    //        ]);
//
    //    if ($response->failed()) {
    //        \Log::error('OpenAI Error', ['body' => $response->body()]);
    //        return [];
    //    }
//
    //    $text = $response['choices'][0]['message']['content'] ?? '';
//
    //    return array_filter(array_map(function ($line) {
    //        return preg_replace('/^\d+\.\s*/', '', trim($line));
    //    }, explode("\n", $text)));
    //}

    public function generateTitles($category)
    {
        return [
            "$category Full Course",
            "$category for Beginners",
            "Learn $category Step by Step",
            "$category Bootcamp",
            "$category Complete Guide",
        ];
    }

}