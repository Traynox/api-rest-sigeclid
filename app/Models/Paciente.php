<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $primaryKey='id_paciente';
    protected $table='pacientes';
    public $timestamps=false;
    protected $fillable=[
        'nombre',
        'cedula',
        'apellido_uno',
        'apellido_dos',
        'sexo',
        'telefono',
        'edad',
        'correo',
        'direccion',
        'estado'
    ];
    public function citas()
    {
        //$fecha=request('fecha');//obtiene el valor de cualquier valor que se mando del ultimo form mediante el nombre
        return $this->hasMany(Cita::class,'id_paciente');
    }
    public function expediente()
    {
        //$fecha=request('fecha');//obtiene el valor de cualquier valor que se mando del ultimo form mediante el nombre
        return $this->belongsTo(Expediente::class,'id_paciente');
    }
    public function scopeFilter($query,$buscar)
    {
        // $buscar=request('buscar');
        return $query->whereHas('expediente',
        function($query) use ($buscar){
            if($buscar){
                return $query->where('codigo','like','%'.$buscar.'%')
                ->orWhere('fecha_creacion','like','%'.$buscar.'%');
                
            }
    })->where('nombre','like','%'.$buscar.'%')
                    ->orWhere('cedula','like','%'.$buscar.'%')
                    ->orWhere('apellido_uno','like','%'.$buscar.'%')
                    ->orWhere('apellido_dos','like','%'.$buscar.'%')
                    ->orWhere('sexo','like','%'.$buscar.'%')
                    ->orWhere('telefono','like','%'.$buscar.'%')
                    ->orWhere('edad','like','%'.$buscar.'%')
                    ->orWhere('correo','like','%'.$buscar.'%')
                    ->orWhere('direccion','like','%'.$buscar.'%');
      
    }

}
