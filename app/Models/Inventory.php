<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',  // Permitir la asignación masiva de 'product_id'
        'stock_before',
        'stock_after',
        'change_reason',
    ];

    // Relaciones del inventario
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
