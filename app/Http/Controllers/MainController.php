<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index() : View
    {
        $posts = Post::with('user')->get();
        return view('dashboard', ['posts' => $posts]);
    }

    public function createPost()
    {
        if(Gate::denies('post.create')){
            \abort('403', 'Você não tem permição para criar posts');
        }
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        if(Gate::denies('post.delete', $post)){
            \abort('403', 'Você não tem permição para deletar posts');
        }

        // delete post
        $post->delete();

        return \redirect()->route('dashboard');
    }
}
