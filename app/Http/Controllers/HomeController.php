<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //recupera o ID do usuário que está logado
        $user_id = Auth::id();
        //recuperar o usuário com os seus posts
        $user = User::where('id',$user_id)->with('posts', 
                                                 'posts.comments', 
                                                 'posts.comments.user', 
                                                 'posts.likes', 
                                                 'posts.likes.user',
                                                 'posts.photos')->first();
        //dd($user);
        //guarda os posts em uma variável chamada listaPosts
        $listaPosts = $user->posts()->orderBy('created_at','desc')->get();
        
        //chama a view home e envia os posts
        return view('home',['listaPosts' => $listaPosts]);
    }
}


//editar comentário, excluir comentário, permitir fazer upload de mais fotos
