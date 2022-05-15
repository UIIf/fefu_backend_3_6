<?php

namespace App\OpenApi\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class LoginParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('email')
                ->description('Email')
                ->required(true)
                ->schema(Schema::string())
                ->example("test@test.com"),

            Parameter::query()
                ->name('password')
                ->description('Password')
                ->required(true)
                ->schema(Schema::string())
                ->example("123456"),
        ];
    }
}