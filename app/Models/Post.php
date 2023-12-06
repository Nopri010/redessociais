<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    //Método usado para recuperar o usuário dono do post
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Método usado para recuperar os comentários do post
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //Método usado para recuperar as fotos do post
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    //Método usado para recuperar os likes do post
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
