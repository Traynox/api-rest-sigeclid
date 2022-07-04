<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;

    protected $primaryKey='id_tratamiento';
    protected $table='tratamientos';
    public $timestamps=false;
    protected $fillable=[
        'descripcion',
        'monto',
        'id_tenant',
    ];


    public function scopeFilter($query,$buscar)
    {
        // $buscar=request('buscar');
        return $query->where('descripcion','like','%'.$buscar.'%')
                    ->orWhere('monto','like','%'.$buscar.'%');
      
    }

}

