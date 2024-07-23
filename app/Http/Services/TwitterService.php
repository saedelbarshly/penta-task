<?php
namespace App\Http\Services;


use Illuminate\Support\Facades\Http;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterService
{
    protected $baseUrl = 'https://api.twitter.com/2/';

    public function searchTweets($query, $count)
    {
        try {
            $endpoint = 'tweets/search/recent';
            $url = $this->baseUrl . $endpoint;
    
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('BEARER_TOKEN'),
                'Content-Type' => 'application/json'
            ])->get($url, [
                'query' => $query,
                'max_results' => $count
            ]);
            return $response->json();
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }
}