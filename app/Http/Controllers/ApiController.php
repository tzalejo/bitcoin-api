<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;

# Controlador base para todo nuestro controller..
class ApiController extends Controller
{
    # con esto podemos indicarle para cada uno de los controller el uso de la clase Traits, sin que estemos importanda en cada uno de ellos..
    use ApiResponser;
}
