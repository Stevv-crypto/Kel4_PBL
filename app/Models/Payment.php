<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    protected $fillable = [
        'category',
        'method_name',
        'account_name',
        'account_number',
        'logo_path',
    ];

    // Relasi: satu metode pembayaran bisa digunakan di banyak order
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
