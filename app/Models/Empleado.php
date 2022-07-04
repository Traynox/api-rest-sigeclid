<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $primaryKey='id_empleado';
    protected $table='empleados';
    public $timestamps=false;
    protected $fillable=[
        'nombre',
        'cedula',
        'telefono',
        'direccion',
        'ocupacion',
        'id_tenant',
        'estado'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class,'id_cita');
    }

    public function scopeFilter($query,$buscar)
    {
        // $buscar=request('buscar');
        return $query->where('nombre','like','%'.$buscar.'%')
                    ->orWhere('cedula','like','%'.$buscar.'%')
                    ->orWhere('telefono','like','%'.$buscar.'%')
                    ->orWhere('direccion','like','%'.$buscar.'%')
                    ->orWhere('ocupacion','like','%'.$buscar.'%');
      
    }
}
