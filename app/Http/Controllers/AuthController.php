<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserEmpresa;
use Illuminate\Http\Request;

class AuthController extends Controller
{
       /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $validation = request()->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'empresa' => ['required', 'string']
        ]);

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userEmpresa = User::select('empresas.nome', 'empresas.uuid', 'empresas.cnpj')
            ->join('user_empresas', 'user_empresas.user_id', '=', 'users.id')
            ->join('empresas', 'user_empresas.empresa_id', '=','empresas.id')
            ->where('users.email', auth('api')->user()->email)
            ->get();

        return $this->respondWithToken($token, $userEmpresa);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(
            [
                'name' => auth('api')->user()->name,
                'email' => auth('api')->user()->email,
            ]
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $empresa = null)
    {




        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => [
                'name' => auth('api')->user()->name,
                'email' => auth('api')->user()->email,
            ],
            'empresa'=> $empresa
        ]);
    }
}
