<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

trait ApiResponser
{
    # para cuando fue satisfactorio
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }
    # para los errores
  
    protected function errorResponse($msg, $code)
    {
        return response()->json($msg, $code);
    }
    # cuando devolvemos una colecciones de elementos json
    protected function showAll(Collection $data, $code=200)
    {
        return $this->successResponse($data, $code);
    }
  
    protected function showOne(Model $instancia, $code=200)
    {
        return $this->successResponse($instancia, $code);
    }

    private function showArray($array, $code=200)
    {
        return $this->successResponse($array, $code);
    }
}
