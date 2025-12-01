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
        'IMG_URL',
        'ACTIVE_FLAG',
        'CREATE_DATE',
        'UPDATE_DATE',
    ];

    protected $dates = ['deleted_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'CATE_ID', 'ID');
    }
}
