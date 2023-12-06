<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Post;
use \App\Models\User;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //pego a lista de usuários
        $listaUsuarios = User::all();
        //pego a lista de posts
        $listaPosts = Post::all();

        //faço um laço de repetição em que para cada usuário
        //cadastrado, eu "vinculo" uma série aleatória (random) de posts no 
        //relacionamento de like (curtir), ou seja, um usuário, curtiu um post
        //se fosse pra eu fazer a curtida para um usuário eu faria da seguinte forma:
        //$umUsuario->likedPosts()->attach($umPost);

        foreach($listaUsuarios as $umUsuario){
            //preste atenção em como eu faço o "vínculo" entre o usuário e o post
            $umUsuario->likedPosts()->attach($listaPosts->random($listaPosts->count()/2));
        }
    }
}
