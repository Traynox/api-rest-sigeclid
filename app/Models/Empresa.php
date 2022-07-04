<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $primaryKey='id_tenant';
    protected $table='empresas';
    public $timestamps=false;
    protected $fillable=[
        'nombre',
        'eslogan',
        'telefono',
        'direccion',
        'imagen',
    ];
}
