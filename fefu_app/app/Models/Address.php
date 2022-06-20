<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'street',
        'house',
        'apartment'
    ];

    public static function storeFromRequest(Request $request)
    {
        return self::create([
            'city' => $request->input('delivery_address')['city'],
            'street' => $request->input('delivery_address')['street'],
            'house' => $request->input('delivery_address')['house'],
            'apartment' => $request->input('delivery_address')['apartment'] ?? null,
        ]);
    }
}