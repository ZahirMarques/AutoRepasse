<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca',
        'modelo',
        'ano_modelo',
        'placa',
        'renavam',
        'cor',
        'chassi',
        'cod_seg_crv',
        'cod_seg_cla',
        'cla',
        'crv',
        'atpve',
        'proprietario_id',
        'combustivel',
        'categoria',
        'situacao'
    ];

    public function proprietario()
    {
        return $this->belongsTo(Cliente::class, 'proprietario_id');
    }
    
    protected $guarded = [];
}
