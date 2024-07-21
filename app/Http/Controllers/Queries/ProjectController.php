<?php

namespace App\Http\Controllers\Queries;

use App\Http\Controllers\Controller;
use App\Http\Requests\Queries\ProjectRequest;
use App\Http\Resources\Queries\ProjectResource;
use App\Models\Queries\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return ProjectResource::collection($projects);
    }

    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->all());
        return [
            "msg" => "Add Successfully",
            "data" => new ProjectResource($project),
        ];
    }
}
