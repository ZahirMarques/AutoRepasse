<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'veiculo',
        'ano_modelo',
        'placa',
        'renavam',
        'cor',
        'chassi',
        'cod_seg_crv',
        'cod_seg_cla',
        'crv',
        'atpve',
        'proprietario_id'
    ];

    public function proprietario()
    {
        return $this->belongsTo(Pessoa::class, 'proprietario_id');
    }
    
    protected $guarded = [];
}
