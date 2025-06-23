<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_code', 'code_product', 'quantity', 'subtotal'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_code', 'order_code');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'code_product', 'code_product');
    }
}
