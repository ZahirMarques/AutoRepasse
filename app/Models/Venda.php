<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'financiamento' => 'boolean',
        'tipo',
        'veiculo_id',
        'pessoa_id',
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class);
    }

    public function veiculo(){
        return $this->belongsTo(Veiculo::class);
    }
}
