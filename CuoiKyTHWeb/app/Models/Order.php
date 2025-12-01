<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;  
class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'product_id',
        'name',
        'so_luong',
        'don_gia',
        'user_id',
    ];

    // Một đơn hàng thuộc về 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Một đơn hàng thuộc 1 sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
