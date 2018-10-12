<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskPriorities;
use App\TaskStatuses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function createOrUpdate(Request $request, $id = 0): JsonResponse
    {
        $task = $id
            ? Task::find($id)
            : new Task();

        // return error if task is not found
        if ($id && !$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $due_at = $request->get('due_at');

        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->priority = (int) $request->get('priority', TaskPriorities::HIGH);
        $task->status = (int) $request->get('status', TaskStatuses::TODO);
        $task->due_at = $due_at
            ? (new \DateTime($due_at))->format('Y-m-d')
            : null;

        // return error if input is invalid
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
        return response()->json($task->toApi(), $id ? 200 : 201);
    }

    public function delete()
    {

    }
}
