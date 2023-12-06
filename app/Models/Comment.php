<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'post_id'];

    //Método responsável por recuperar o usuário que fez o comentário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Método responsável por recuperar o post que foi feito o comentário
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
