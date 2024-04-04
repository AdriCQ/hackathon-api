<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\Subgroup;
use Symfony\Component\HttpFoundation\Response;

#[Group('Usuarios')]
#[Subgroup('Autenticación')]
class AuthController extends Controller
{
    /**
     * Usuario Actual
     */
    #[Endpoint('Usuario Actual')]
    #[Authenticated]
    #[ResponseFromApiResource(
        UserResponse::class,
        User::class
    )]
    public function currentUser(): UserResponse
    {
        return new UserResponse(
            auth()->user()
        );
    }

    /**
     * Login
     */
    #[Endpoint('Login')]
    #[ResponseFromApiResource(
        UserResponse::class,
        User::class
    )]
    public function login(LoginRequest $request): UserResponse|JsonResponse
    {
        $validated = $request->validated();

        if (
            auth()->attempt([
                'telefono' => $validated['telefono'],
                'password' => $validated['password'],
            ])
        ) {
            $user = auth()->user();
            $token = $request->user()->createToken('auth_token');

            return (new UserResponse($user))
                ->additional(['auth_token' => $token->plainTextToken]);
        }

        return response()->json(['message' => 'Credenciales incorrectas'], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Registrar Nuevo Usuario
     */
    #[Endpoint('Registrar Nuevo Usuario')]
    #[ResponseFromApiResource(
        UserResponse::class,
        User::class
    )]
    public function register(RegisterRequest $request): UserResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'nombre' => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'email' => $validated['email'],
            'telefono' => $validated['telefono'],
            'password' => bcrypt($validated['password']),
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
        ]);

        auth()->login($user);

        $token = $request->user()->createToken('auth_token');

        return (new UserResponse($user))
            ->additional(['auth_token' => $token->plainTextToken]);
    }
}
