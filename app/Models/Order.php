<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\Order_Product;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'shipping_total',
        'products_total',
        'total',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    /**
     * Get all of the Order_Product for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_product()
    {
        return $this->hasMany(Order_Product::class, 'order_id', 'id');
    }
}
