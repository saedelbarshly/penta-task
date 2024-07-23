<?php

namespace App\Http\Controllers\Queries;

use App\Http\Controllers\Controller;
use App\Http\Requests\Queries\JobRequest;
use App\Http\Resources\Queries\JobResource;
use App\Models\Queries\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return JobResource::collection($jobs);
    }

    public function store(JobRequest $request)
    {
        try {
            $job = Job::create($request->all());
            return [
                "msg" => "Add Successfully",
                "data" => new JobResource($job),
            ];
        } catch (\Throwable $th) {
            return [
                "msg" => "Something went wrong",
                "error" => $th->getMessage(),
            ];
        }
    }
}
