<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Product;
use App\Models\Images;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discounts';
    protected $fillable = ['discount', 'start_discount', 'end_discount', 'product_id'];

    public function products(): HasOne 
    {
        return $this->hasOne(Product::class, 'id');
    }

    public function images():HasOne
    {
        return $this->hasOne(Images::class, 'product_id');
    }

}
