<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //crio um usuário para eu testar a aplicação
        $this->call(UserTableSeeder::class);
        
        //crio vários usuários, posts e comentários fake no bd
        \App\Models\User::factory(10)->create();
        \App\Models\Post::factory(100)->create();
        \App\Models\Comment::factory(1000)->create();
        
        //crio alguns relacionamentos de seguir/seguido
        $this->call(SeguidorTableSeeder::class);
        
        //crio alguns likes em alguns posts
        $this->call(LikesTableSeeder::class);
    }
}
