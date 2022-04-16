<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class PaginatorMetaSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('PaginatorMeta')
            ->properties(
                Schema::integer('current_page'),
                Schema::integer('from')->nullable(),
                Schema::integer('last_page'),
                Schema::array('links')->items(
                    Schema::object()->properties(
                        Schema::string('url')->nullable(),
                        Schema::string('label'),
                        Schema::boolean('active'),
                    ),
                ),
                Schema::string('path'),
                Schema::integer('per_page'),
                Schema::integer('to'),
                Schema::integer('total'),
            );
    }
}
