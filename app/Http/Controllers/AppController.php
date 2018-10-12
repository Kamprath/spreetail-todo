<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\View\View;

class AppController extends Controller
{
    public function index(): View
    {
        return view('app', [
            'tasks' => Task::getAll()
        ]);
    }
}
