<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistorialTodoController extends Controller
{
    public function index()
    {
        return view('historial_todo.index');
    }
}
