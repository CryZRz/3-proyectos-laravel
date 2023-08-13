<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    protected $dates = ["ultimo_dia"];
    
    protected $fillable = [
        "titulo",
        "salario_id",
        "categoria_id",
        "empresa",
        "ultimo_dia",
        "descripcion",
        "imagen",
        "user_id"
    ];

    public function categoria(){
        //ManyToOne mucho a uno
        return $this->belongsTo(Categoria::class);
    }

    public function salario(){
        //ManyToOne mucho a uno
        return $this->belongsTo(Salario::class);
    }

    public function candidatos(){
        //OneToMany
        return $this->hasMany(Candidato::class)->orderBy("created_at", "desc");
    }

    public function reclutador(){
        //OneToOne
        return $this->belongsTo(User::class, "user_id");
    }
}
