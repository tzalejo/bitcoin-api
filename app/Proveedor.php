<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dni','nombre', 'apellido', 'telefono', 'email'
    ];

    public function formularios(){
        return $this->hasMany(Formulario::class);
    }
}
