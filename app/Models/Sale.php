<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // Add 'user_id' to the fillable property
    protected $fillable = [
        'user_id', // Allow mass assignment for 'user_id'
        'total',
        'payment_method',
    ];

    // Sale relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
