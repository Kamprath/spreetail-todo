<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskPriorities;
use App\TaskStatuses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $due_at = $request->get('due_at');

        $task = new Task();
        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->priority = (int) $request->get('priority', TaskPriorities::HIGH);
        $task->status = TaskStatuses::TODO;
        $task->due_at = $due_at
            ? (new \DateTime($due_at))->format('Y-m-d H:i:s')
            : null;

        // validate input
        if (!$task->title) {
            return response()->json(['message' => 'Title is required'], 400);
        }

        // attempt to create model
        try {
            $task->save();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        // return created model
        return response()->json($task->toArray(), 201);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
