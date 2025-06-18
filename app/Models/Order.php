<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $primaryKey = 'order_code';
    public $incrementing = false; // Karena order_code bukan auto-increment
    protected $keyType = 'string';

    protected $fillable = [
        'order_code',
        'user_id',
        'payment_id',
        'status',
        'total_price',
        'payment_proof',
    ];

    // Relasi: order dimiliki oleh satu user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: order memakai satu metode pembayaran
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    // Relasi: order punya banyak item
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_code', 'order_code');
    }
}
