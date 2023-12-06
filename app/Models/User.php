<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Método usado para recuperar os posts do usuário
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Método usado para recuperar os comentários do usuário
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //Método usado para recuperar os seguidores do usuário
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_relationships', 'followed_id', 'follower_id');
    }

    //Método usado para recuperar quem o usuário está seguindo
    public function follows()
    {
        return $this->belongsToMany(User::class, 'user_relationships', 'follower_id', 'followed_id');
    }

    //Método usado para recuperar os posts curtidos pelo usuário
    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps();
    }

}
