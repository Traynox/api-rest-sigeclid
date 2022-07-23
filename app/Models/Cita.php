<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $primaryKey='id_cita';
    protected $table='citas';
    public $timestamps=false;
    protected $fillable=[
        'start',
        'end',
        'comentario',
        'estado'
    ];

    public function paciente()
    {
        //$fecha=request('fecha');//obtiene el valor de cualquier valor que se mando del ultimo form mediante el nombre
       
        return $this->belongsTo(Paciente::class,'id_paciente');
    }
    public function empleado()
    {
        //$fecha=request('fecha');//obtiene el valor de cualquier valor que se mando del ultimo form mediante el nombre
       
        return $this->belongsTo(Empleado::class,'id_empleado');
    }

    public function tratamientos()
    {
        //$fecha=request('fecha');//obtiene el valor de cualquier valor que se mando del ultimo form mediante el nombre
       
        return $this->hasMany(Tratamiento::class,'id_tratamiento');
    }
//PENDIENTE
    public function scopeFilter($query,$buscar)
    {
        // $buscar=request('buscar');
        return $query->where('nombre','like','%'.$buscar.'%')
                    ->orWhere('apellido','like','%'.$buscar.'%')
                    ->orWhere('telefono','like','%'.$buscar.'%');
                   
      
    }
}
