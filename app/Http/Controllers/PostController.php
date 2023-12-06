<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;
use \App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function show($id){
        $post = Post::where('id', $id)->with('comments',
                                             'comments.user',
                                             'likes',
                                             'likes.user',
                                             'photos')->first();
        $user = Auth::user();
        return view('posts.show',['post' => $post, 'user' => $user]);
    }

    // demonstração dos slides
    // public function show($id){
    //     $post = Post::where('id', $id)->with('user')->first();
    //     $user = Auth::user();
    //     return view('posts.show',['post' => $post, 'user' => $user]);
    // }

    public function create(Request $request){
        
        Log::info($request);

        //vetor com as mensagens de erro
        $messages = array(
            'content.required' => 'É obrigatório um conteúdo para o post',
            'content.max' => 'Seu post tem que ter no máximo 255 caracteres',
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
        $post = new Post();
        $post->content = $request['content'];
        $post->user_id = Auth::id();
        $post->save();

        $arquivos = $request['file'];
        Log::info("quantidade: " . count($arquivos));

        for($i=0; $i < count($arquivos); $i++){
            $image = $arquivos[$i];
            Log::info($image);
            $imageName = time(). '_' . $i .'.'.$image->extension();
            Log::info("nome: " . $imageName);
            $image->move(public_path('storage/image/'),$imageName);
            Log::info("movimentou");

            $foto = new Photo();
            $foto->image_path = $imageName;
            $foto->post_id = $post->id;
            $foto->save();
        }

        return redirect('home')->with('success','Post cadastrado com sucesso!');
        //return response()->json(['success'=>$imageName]);
    }

    public function like($id){
        $post = Post::find($id);
        $usuarioLogado = Auth::user();

        $usuarioLogado->likedPosts()->attach($post);

        return redirect()->back();
    }

    public function deslike($id){
        $post = Post::find($id);
        $usuarioLogado = Auth::user();

        $usuarioLogado->likedPosts()->detach($post);

        return redirect()->back();
    }

    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }
}
