<?php

namespace App\OpenApi\Responses\auth;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;

class UserTokenResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()->example(['token' => 'token_string']);

        return Response::create('User Token')
            ->description('User Token')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}