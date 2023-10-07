<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Order;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
            'product_id',
            'buyer',
            'no_phone',
            'city',
            'total',
            'status',
            'notes',
    ];

    public function orderDetails() {
        return $this->hasMany(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    
    
}
