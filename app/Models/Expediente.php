<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;
    protected $primaryKey='id_expediente';
    protected $table='expedientes';
    public $timestamps=false;
    protected $fillable=[
        'codigo',
        'fecha_creacion',
        'estado'
    ];



    public function tratamientos()
    {
        return $this->belongsToMany(Tratamiento::class, 'expedientes_tratamientos', 'id_expediente', 'id_tratamiento')
        ->withPivot('id_expediente','id_tratamiento');
    }

    public function paciente()
    {
        //$fecha=request('fecha');//obtiene el valor de cualquier valor que se mando del ultimo form mediante el nombre
        return $this->belongsTo(Paciente::class,'id_paciente');
    }
}
