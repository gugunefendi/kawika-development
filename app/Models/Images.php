<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;
use App\Models\Discount;

class Images extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'nama_file',
        'path',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'product_id');
    }
}
