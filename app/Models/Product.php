<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Images;
use App\Models\Variant;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'product_name',
        'product_description',
        'product_price',
        'product_stock',
        'product_weight'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): hasMany
    {
        return $this->hasMany(Images::class);
    }

    public function variants(): hasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function discounts(): HasOne
    {
        return $this->hasOne(Discount::class, 'product_id', 'id');
    }
}
