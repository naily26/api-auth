<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Product;

class Cart_Product extends Model
{
    use HasFactory;
    protected $table = 'cart_product';

    protected $fillable = [
        'cart_id',
        'product_id',
        'qty'
    ];

    /**
     * The cart that belong to the Cart_Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * The product that belong to the Cart_Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    /**
     * The roles that belong to the Cart_Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function roles(): BelongsToMany
    // {
    //     return $this->belongsToMany(Role::class, 'role_user_table', 'user_id', 'role_id');
    // }
}
