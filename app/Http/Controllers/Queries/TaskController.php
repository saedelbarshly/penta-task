<?php

namespace App\Http\Controllers\Queries;

use App\Http\Controllers\Controller;
use App\Http\Requests\Queries\TaskRequest;
use App\Http\Resources\Queries\TaskResoursce;
use App\Models\Queries\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return TaskResoursce::collection($tasks);
    }

    public function store(TaskRequest $request)
    {
        try {
            $task = Task::create($request->all());
            return [
                "msg" => "Add Successfully",
                "data" => new TaskResoursce($task),
            ];
        } catch (\Throwable $th) {
            return [
                "msg" => "Something went wrong",
                "error" => $th->getMessage(),
            ];
        }
    }

    public function getTasksByProjectPrice($price)
    {
        $tasks = Task::whereHas('job.project', function ($query) use ($price) {
            $query->where('price', '<', $price);
        })->get();

        return TaskResoursce::collection($tasks);
    }
}
