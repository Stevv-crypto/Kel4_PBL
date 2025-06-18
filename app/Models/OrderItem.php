<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_code',
        'code_product',
        'quantity',
        'subtotal',
    ];

    // Relasi: item milik satu order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_code', 'order_code');
    }

    // Relasi: item berhubungan dengan satu produk
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'code_product', 'code_product');
    }
}
