<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Illuminate\Foundation\Http\FormRequest;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class SuccessValidationResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response');
    }
}