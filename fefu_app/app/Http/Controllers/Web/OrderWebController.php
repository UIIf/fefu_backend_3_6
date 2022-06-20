<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderWebController extends Controller
{
    public function index()
    {
        return view('checkout.index', [
            'user' => Auth::user()
        ]);
    }

    public function store(OrderStoreRequest $request)
    {
        $address = null;
        if (!self::containsOnlyNull($request->input('delivery_address'))) {
            $address = Address::storeFromRequest($request);
        }

        $cart = Cart::getOrCreateCart($request->user(), null);

        if ($cart->isEmpty()) {
            return back()->withErrors([
               '' => 'cart is empty'
            ]);
        }

        $cart->user_id = null;
        $cart->session_id = null;
        $cart->save();

        Order::storeFromRequest($request, $address, $cart);

        return redirect(route('profile'));
    }

    private function containsOnlyNull($input)
    {
        return empty(array_filter($input, function ($a) { return $a !== null;}));
    }
}