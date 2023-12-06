<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    //demonstração nos slides
    // public function index()
    // {
    //     $listaUsuarios = User::simplePaginate(5);
    //     return view('users.list', ['listaUsuarios' => $listaUsuarios]);
    // }

    //demonstração nos slides
    // public function index()
    // {
    //     $user_id = Auth::id();
    //     $usuarioAutenticado = User::where('id',$user_id)->with('follows')->first();
    //     return view('users.list', ['usuarioAutenticado' => $usuarioAutenticado]);
    // }
    
    
    public function index()
    {
        $listaUsuarios = User::simplePaginate(5);
        $user_id = Auth::id();
        $usuarioAutenticado = User::where('id',$user_id)->with('follows')->first();
        return view('users.list', ['listaUsuarios' => $listaUsuarios, 
                                   'usuarioAutenticado' => $usuarioAutenticado]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::where('id',$id)->with('posts', 
                                            'posts.comments', 
                                            'posts.comments.user', 
                                            'posts.likes', 
                                            'posts.likes.user',
                                            'posts.photos',
                                            'follows', 
                                            'followers')->first();
        $user_id = Auth::id();
        $usuarioAutenticado = User::where('id',$user_id)->with('follows')->first();
        return view('users.show', ['user' => $user,'usuarioAutenticado' => $usuarioAutenticado]);
    }

    public function follow($id){
        $usuarioParaSeguir = User::find($id);
        $usuarioLogado = Auth::user();

        $usuarioLogado->follows()->attach($usuarioParaSeguir);

        return redirect()->back();
    }

    public function unfollow($id){
        $usuarioParaNaoSeguir = User::find($id);
        $usuarioLogado = Auth::user();

        $usuarioLogado->follows()->detach($usuarioParaNaoSeguir);

        return redirect()->back();
    }
}
