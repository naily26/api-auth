<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart_Product;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'gambar'
    ];

    /**
     * The roles that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cart_product()
    {
        return $this->belongsToMany(Cart_Product::class, 'cart_product', 'id', 'product_id');
    }

}
