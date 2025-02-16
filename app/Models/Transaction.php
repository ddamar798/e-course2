<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_trx_id',
        'user_id',
        'pricing_id',
        'sub_total_amount',
        'grans_total_amount',
        'total_tax_amount',
        'is_paid',
        'payment_type',
        'proof',
       'started_at',
       'ended_at',
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
    ];

    public function pricing()
    {
        return $this->belongsTo(Pricing::class, 'pricing_id');
    }

    public function student()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    // Untuk cek apakah transaksi masih aktif atau expired.
    public function isActive(): bool
    {
        return $this->is_paid && $this->ended_at->isFuture();
    }
}