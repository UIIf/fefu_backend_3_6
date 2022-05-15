<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseLoginApiRequest;
use App\Http\Requests\BaseRegisterApiRequest;
use App\Models\User;
use App\OpenApi\Parameters\LoginParameters;
use App\OpenApi\Parameters\RegisterParameters;
use App\OpenApi\Responses\FailedValidationResponse;
use App\OpenApi\Responses\auth\GetUserResponse;
use App\OpenApi\Responses\auth\LogoutUserResponse;
use App\OpenApi\Responses\auth\NotFoundUserResponses;
use App\OpenApi\Responses\auth\UserTokenResponse;
use App\OpenApi\Responses\auth\SuccessRegisterUserResponse;
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
    #[OpenApi\Response(factory: GetUserResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundUserResponses::class, statusCode: 401)]
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
    #[OpenApi\Parameters(factory: LoginParameters::class)]
    #[OpenApi\Response(factory: UserTokenResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: FailedValidationResponse::class, statusCode: 422)]
    #[OpenApi\Response(factory: NotFoundUserResponses::class, statusCode: 401)]
    public function login(BaseLoginApiRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data, true)) {
            $user = Auth::user();
            $authToken = $user->create_token('authToken')->plainTextToken;

            return response()->json([
                'authToken' => $authToken,
            ]);
        }

        // Auth::attempt может вернуть ложь, если произошла ошибка валидации или пользователь не найден,
        // поэтому обработал второй вариант отдельно, может можно умнее как-то, но я не знаю :)
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
    #[OpenApi\Parameters(factory: RegisterParameters::class)]
    #[OpenApi\Response(factory: FailedValidationResponse::class, statusCode: 422)]
    #[OpenApi\Response(factory: UserTokenResponse::class, statusCode: 200)]
    public function register(BaseRegisterApiRequest $request)
    {
        $data = $request->validated();
        $user = User::createFormRequest($data);

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
    #[OpenApi\Response(factory: LogoutUserResponse::class, statusCode: 200)]
    public function logout(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json('Successfull logout');

    }


}