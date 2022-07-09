<?php

namespace App\Models;

use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Rss extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function post(){
        return $this->hasMany(Post::class);
    }
}
