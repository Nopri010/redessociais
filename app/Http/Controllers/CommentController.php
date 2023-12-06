<?php

namespace App\Http\Controllers;

use \App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function create(Request $request){
        //vetor com as mensagens de erro
        $messages = array(
            'content.required' => 'É obrigatório um conteúdo para o comentário',
            'content.max' => 'Seu comentário tem que ter no máximo 255 caracteres'
        );

        //vetor com as especificações de validações
        $regras = array(
            'content' => 'required|string|max:255',
        );

        //cria o objeto com as regras de validação
        $validador = Validator::make($request->all(), $regras, $messages);

        //executa as validações
        if ($validador->fails()) {
            return redirect()->back()
            ->withErrors($validador)
            ->withInput($request->all);
        }

        //se passou pelas validações, processa e salva no banco...
        $comment = new Comment();
        $comment->content = $request['content'];
        $comment->user_id = Auth::id();
        $comment->post_id = $request['post_id'];
        $comment->save();

        return redirect()->back();
    }
}
