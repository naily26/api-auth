<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\Cart_Product;

class Cart extends Model
{
    use HasFactory;
    protected $table= 'cart';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'total'
    ];

    /**
     * Get the user that owns the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    /**
     * The roles that belong to the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cart_product()
    {
        return $this->belongsToMany(Cart_Product::class);
    }
}
