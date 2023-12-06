<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    //Método utilizado para recuperar o Usuário que deu uma curtida
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Método utilizado para recuperar o Post da curtida
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
