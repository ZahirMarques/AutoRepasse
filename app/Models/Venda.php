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
}
