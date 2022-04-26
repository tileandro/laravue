<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $table = 'tabela_2022';
    protected $fillable = ['time', 'ponto', 'jogo', 'vitoria', 'empate', 'derrota', 'gols_pro', 'gols_contra', 'saldo_gols', 'escudo'];
}
