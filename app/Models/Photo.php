<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    //Método utilizado para recuperar o post o qual uma foto pertence
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
