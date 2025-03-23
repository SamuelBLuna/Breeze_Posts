<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index() : View
    {
        $posts = Post::with('user')->get();
        return view('dashboard', ['posts' => $posts]);
    }
}
