<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\OpenApi\RequestBodies\OrderStoreRequestBody;
use App\OpenApi\Responses\cart\EmptyCartResponse;
use App\OpenApi\Responses\OrderOkResponse;
use App\OpenApi\Responses\OrderValidationErrorResponse;
use Illuminate\Http\JsonResponse;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class OrderApiController extends Controller
{
    /**
     * send new order
     *
     * @return JsonResponse
     *
     * @method POST
     */
    #[OpenApi\Operation(tags: ['orders'])]
    #[OpenApi\Response(factory: OrderOkResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: OrderValidationErrorResponse::class, statusCode: 422)]
    #[OpenApi\Response(factory: EmptyCartResponse::class, statusCode: 422)]
    #[OpenApi\RequestBody(factory: OrderStoreRequestBody::class)]
    public function store(OrderStoreRequest $request)
    {
        $address = null;
        if (!self::containsOnlyNull($request->input('delivery_address'))) {
            $address = Address::storeFromRequest($request);
        }

        $cart = Cart::getOrCreateCart($request->user(), null);

        if ($cart->isEmpty()) {
            return new JsonResponse([
                'message' => 'cart is empty'
            ], status: 422);
        }

        $cart->user_id = null;
        $cart->session_id = null;
        $cart->save();

        $order = Order::storeFromRequest($request, $address, $cart);

        return OrderResource::make($order);
    }

    private function containsOnlyNull($input)
    {
        return empty(array_filter($input, function ($a) { return $a !== null;}));
    }
}