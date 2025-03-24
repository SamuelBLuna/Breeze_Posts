<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('user')->get();
        return view('dashboard', ['posts' => $posts]);
    }

    public function createPost()
    {
        if (Gate::denies('post.create')) {
            \abort('403', 'Você não tem permição para criar posts');
        }
        return view('create-post');
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        if (Gate::denies('post.delete', $post)) {
            \abort('403', 'Você não tem permição para deletar posts');
        }

        // delete post
        $post->delete();

        return \redirect()->route('dashboard');
    }

    public function storePost(Request $request)
    {
        if (Gate::denies('post.create')) {
            \abort('403', 'Você não tem permição para criar posts');
        }

        $request->validate(
            [
                'title' => 'required|min:3|max:100',
                'text' => 'required|min:3|max:1000',
            ],
            [
                'title.required' => 'O campo é obrigatório.',
                'title.min' => 'O campo deve ter no mínimo :min caracteres',
                'title.max' => 'O campo deve ter no máximo :min caracteres',
                'text.required' => 'O campo é obrigatório.',
                'text.min' => 'O campo deve ter no mínimo :min caracteres',
                'text.max' => 'O campo deve ter no máximo :min caracteres',
            ]
        );

        Post::create([
            'title' => $request->title,
            'text' => $request->text,
            'user_id' => Auth::user()->id
        ]);

        return \redirect()->route('dashboard');
    }
}
