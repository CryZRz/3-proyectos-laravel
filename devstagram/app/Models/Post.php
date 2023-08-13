<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "titulo",
        "descripcion",
        "imagen",
        "user_id",
    ];

    public function user(){
        //ManyToOne
        return $this->belongsTo(User::class)->select(["name", "username"]);
    }

    public function comentarios(){
        //oneToMany
        return $this->hasMany(Comentario::class);
    }

    public function likes(){
        //oneToMany
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        return $this->likes->contains("user_id", $user->id);
    }  
}
