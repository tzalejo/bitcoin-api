<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\User;

class UserController extends Controller
{
    //
    use ApiResponser;
    /**
     * Devuelvo todas las comisiones activas(que no se cerraron por las fechas)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::query()->orderBy('name','ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $user)
    {

    }
}
