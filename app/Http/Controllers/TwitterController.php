<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\TwitterService;

class TwitterController extends Controller
{
    public function __construct(protected TwitterService $twitterService)
    {
    }

    public function fetchTweets(Request $request)
    {
        $query = $request->input('query');
        $tweets = $this->twitterService->searchTweets($query, 100);
        return response()->json(['message' => 'Tweets fetched successfully.', 'data' => $tweets]);
    }
}
