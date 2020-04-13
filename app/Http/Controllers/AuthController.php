<?php

namespace App\Http\Controllers;

use App\User;
use App\Notifications\SignupActivate;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser;
    public function signup(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'email'         => 'required|string|email',
            'password'      => 'required|string'
        ]);
        #return $request;

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password)
        ]);

        return $this->successResponse(['message' => 'Usuario '.$user->name.' creado satisfactoriamente'], 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'         => 'required|string|email',
            'name'          => 'required_without:email|string',
            'password'      => 'required|string',
            'remember_me'   => 'boolean',
            ]);
        
        if ($request->has('email')) {
            $credenciales = request(['email', 'password']);
        } else {
            $credenciales = request(['name', 'password']);
        }
        # El metrod Auth devuelve true si la autenticacion fue exitosa
        if (!Auth::attempt($credenciales)) {
            # code...
            return $this->errorResponse('No autorizado, verifique sus datos por favor.', 401);
            
        }
      
        $user = $request->user();
        $tokenResult = $user->createToken('Pernsal Access Token');
        $token =  $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        return $this->successResponse([
            'id'            => $user->id,
            'name'          => $user->name,
            'email'         => $user->email,
            'token'         => $tokenResult->accessToken,
            'token_type'    => 'Bearer',
            'expires_at'    => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->successResponse(['message'=>'Salió exitosamente'], 200);
    }

      
    public function delete(Request $request)
    {
        return 'bien';
        #eliminar
    }
}
