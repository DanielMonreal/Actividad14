<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    use HasFactory;

    protected $table = 'titulo';

    protected $fillable = [
        'titulo',
        'autor',
        'fecha_hora',
        'cuerpo_nota',
        'clasificacion'
    ];
}
