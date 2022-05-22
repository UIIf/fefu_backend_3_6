<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppealApiRequest;
use App\Models\Appeal;
use App\OpenApi\Parameters\AppealParameters;
use App\OpenApi\Responses\FailedValidationResponse;
use App\OpenApi\Responses\SuccessValidationResponse;
use App\Sanitizers\PhoneSanitizer;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class AppealApiController extends Controller
{
     /**
     * Sending appeals to the db.
     * @param AppealApiRequest
     * @return JsonResponse
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['appeal'], method: 'POST')]
    #[OpenApi\Parameters(factory: AppealParameters::class)]
    #[OpenApi\Response(factory: FailedValidationResponse::class, statusCode: 422)]
    #[OpenApi\Response(factory: SuccessValidationResponse::class, statusCode: 200)]
    public function store(AppealApiRequest  $request)
    {
        $data = $request->validated();

        $appeal = new Appeal();
        $appeal->name = $data['name'];
        $appeal->phone = PhoneSanitizer::sanitize($data['phone'] ?? null);
        $appeal->email = $data['email'] ?? null;
        $appeal->message = $data['message'];
        $appeal->save();

        return response()->json(
            ['message' => 'Successful'], 200
        );
    }
}