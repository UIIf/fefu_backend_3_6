<?php

namespace App\Models;

use App\Enums\OrderDeliveryType;
use App\Enums\OrderPaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'delivery_type',
        'payment_method',
        'address_id',
        'cart_id'
    ];

    public static function storeFromRequest(Request $request, ?Address $address, Cart $cart)
    {
        $deliveryTypeEnums = OrderDeliveryType::getConstants();
        $paymentMethodEnums = OrderPaymentMethod::getConstants();
        $user = $request->user();

        return self::create([
            'user_id' => $user->id,
            'address_id' => $address?->id,
            'cart_id' => $cart->id,
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'delivery_type' => $deliveryTypeEnums[strtoupper($request->input('delivery_type'))],
            'payment_method' => $paymentMethodEnums[strtoupper($request->input('payment_method'))],
        ]);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}