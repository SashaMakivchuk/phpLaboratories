<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\isEditor;


class EditorController extends Controller
{

    public function __construct()
    {
        // Applying the 'editor' middleware
        $this->middleware('admin')->only('edit', 'delete');
    }

    public function index()
    {
        return view('editor.index');
    }
}
