<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rodada extends Model
{
    use HasFactory;
    protected $table = 'rodada';
    protected $fillable = ['rodada', 'id_time_casa', 'placar_time_casa', 'id_time_fora', 'placar_time_fora', 'data_jogo', 'estadio'];
}
