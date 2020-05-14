<?php

namespace App\Http\Controllers;

use App\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\MensajeRegistro;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Faker\Generator as Faker;
use Faker\Factory;
class AuthController extends Controller
{
    use ApiResponser;
    public function signup(Request $request)
    {
        // return $request;
        $datosValidos = Validator::make($request->all(),[  
            'name'     => 'required|string',
            'apellido' => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);
        #return $request;
        if ($datosValidos->fails()) {
            # si el error es por el mail..
            if ($datosValidos->fails('email.unique')) {
                return $this->errorResponse('El Email del usuario ya esta registrado, verifique', 400);
            }
            $errors = $datosValidos->errors();
            # retorno error 400..
            return $this->errorResponse($errors, 400);
        }

        // creo el usuario
        $user = User::create([
            'name'          => $request->name,
            'apellido'      => $request->apellido,
            'email'         => $request->email,
            'password'      => Hash::make($request->password)
        ]);
        // return $user;
        // genero el token
        $tokenResult = $user->createToken('Pernsal Access Token');
        $token =  $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        
        // email de registracion..
        Mail::to($request->email)
            ->send(new MensajeRegistro($request));
            
        return $this->successResponse([
            'id'            => $user->id,
            'name'          => ucwords(strtolower($user->name)),
            'apellido'      => ucwords(strtolower($user->apellido)),
            'email'         => $user->email,
            'token'         => $tokenResult->accessToken,
            'token_type'    => 'Bearer',
            'expires_at'    => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ], 200);
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
            'apellido'      => $user->apellido,
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

      
    public function resetPassword(Request $request)
    {
        $datosValidos = Validator::make($request->all(),[  
            'email'    => 'required|string|email'
        ]);
        #return $request;
        if ($datosValidos->fails()) {
            $errors = $datosValidos->errors();
            # retorno error 400..
            return $this->errorResponse($errors, 400);
        }

        $usuario = User::where('email',$request->email)->first();
        if (!$usuario) {
            # code...
            return $this->errorResponse(`No existe el usuario con el mail ${$usuario['email']}.`, 400);
        }
        // reseteo password
        $faker = Factory::create();
        // genero un nuevo password
        $nuevoPass = $faker->randomNumber(8, false);
        // Hash::make($nuevoPass);
        $usuario->update([
            'password' => Hash::make($nuevoPass)
        ]);

        // email de registracion..
        $user = ['name' => ucwords(strtolower($usuario->name)), 'apellido' => ucwords(strtolower($usuario->apellido)), 'email' => $usuario->email, 'password' => $nuevoPass ];
        Mail::to($usuario->email)
            ->send(new ResetPassword($user));
        return $this->successResponse(['message'=>'Password Reenviado.'], 200);
    }
}
