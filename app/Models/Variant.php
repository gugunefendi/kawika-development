<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;

class Variant extends Model
{
    use HasFactory;
    protected $table = 'variants';
    protected $fillable = ['product_id'];
    protected $casts = [
        'sizes' => 'json',
        'colors' => 'json',
    ];    

    public function product(): BelongsTo {
        return $this->BelongsTo(Product::class);
    }
}
