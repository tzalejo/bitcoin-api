<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\User;

class UserController extends ApiController
{
    use ApiResponser;
    
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->showAll(User::query()->orderBy('name','ASC')->get());
    }

}
