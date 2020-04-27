<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Cliente extends Model
{
    /**
    *
    * si queremos desactivar los campos de creacion y actualizacion
    * que se crean automaticamente al crear una tabla
    *
    */
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dni', 'nombre', 'apellido', 'telefono', 'email'
    ];

    public function formularios() {
        return $this->hasMany(Formulario::class);
    }
}
