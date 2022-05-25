<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseLoginApiRequest;
use App\Http\Requests\BaseRegisterApiRequest;
use App\Models\User;
use Carbon\Carbon;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

#[OpenApi\PathItem]
class AuthApiController extends Controller
{
    /**
     * output user data
     * @return JsonResponse
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['auth'])]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\auth\GetUserResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\auth\NotFoundUserResponses::class, statusCode: 401)]
    public function getUser(Request $request)
    {
        return $request->user();
    }

    /**
     * login user
     * @param BaseLoginApiRequest
     * @return JsonResponse
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['auth'], method: 'POST')]
    #[OpenApi\Parameters(factory: \App\OpenApi\Parameters\LoginParameters::class)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\auth\UserTokenResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\FailedValidationResponse::class, statusCode: 422)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\auth\NotFoundUserResponses::class, statusCode: 401)]
    public function login(BaseLoginApiRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data, true)) {
            $user = Auth::user();
            $user->app_logged_in_at = Carbon::now();
            $user->save();
            $authToken = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'authToken' => $authToken,
            ]);
        }

        return response()->json([
            $data['email'] => 'user not found or invalid password',
        ], 401);

    }

    /**
     * register user
     * @param BaseRegisterApiRequest
     * @return JsonResponse
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['auth'], method: 'POST')]
    #[OpenApi\Parameters(factory: \App\OpenApi\Parameters\RegisterParameters::class)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\FailedValidationResponse::class, statusCode: 422)]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\auth\UserTokenResponse::class, statusCode: 200)]
    public function register(BaseRegisterApiRequest $request)
    {
        $data = $request->validated();
        $user = User::query()
            ->where('email', $data['email'])
            ->first();

        if ($user !== null) {
            $user = User::changeFromRequest($user, $data);
        } else {
            $user = User::createFromRequest($data);
        }

        $authToken = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'authToken' => $authToken,
        ]);

    }

    /**
     * logout user
     * @return JsonResponse
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['auth'], method: 'POST')]
    #[OpenApi\Response(factory: \App\OpenApi\Responses\auth\LogoutUserResponse::class, statusCode: 200)]
    public function logout(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json('Successfull logout');

    }


}