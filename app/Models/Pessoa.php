<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cidade',
        'estado',
        'cpf',
        'cnpj',
        'contato'
    ];

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'proprietario_id');
    }
}
