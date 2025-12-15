<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_info';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'CATE_ID',   
        'NAME',
        'DESCRIPTION',
        'PRICE',
        'IMG_URL',
        'ACTIVE_FLAG',
        'CREATE_DATE',
        'UPDATE_DATE',
    ];

    protected $casts = [
        'PRICE' => 'integer',
        'CREATE_DATE' => 'datetime',
        'UPDATE_DATE' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    /** Quan hệ đúng */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'CATE_ID', 'ID')
                    ->withTrashed();
    }
}
