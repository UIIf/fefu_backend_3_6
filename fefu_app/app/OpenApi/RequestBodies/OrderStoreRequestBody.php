<?php

namespace App\OpenApi\RequestBodies;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class OrderStoreRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()
            ->required()
            ->description('Store new order')
            ->content(MediaType::json()->schema(
                Schema::object()->properties(
                    Schema::string('customer_name'),
                    Schema::string('customer_email'),
                    Schema::integer('delivery_type')->example('courier OR pickup'),
                    Schema::integer('payment_method')->example('cash OR card'),
                    Schema::array('delivery_address')->items(
                        Schema::object()->properties(
                            Schema::string('city'),
                            Schema::string('street'),
                            Schema::string('house'),
                            Schema::integer('apartment')->nullable()
                        )
                    )
                )
            ));
    }
}