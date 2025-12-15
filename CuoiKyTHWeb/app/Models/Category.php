<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category';
    protected $primaryKey = 'ID';
    protected $dates = ['deleted_at'];

    public $timestamps = false;

    protected $fillable = [
        'TYPE',
        'DESCRIPTION',
        'ACTIVE_FLAG',
        'CREATE_DATE',
        'UPDATE_DATE',
    ];

    protected $casts = [
        'CREATE_DATE' => 'datetime',
        'UPDATE_DATE' => 'datetime',
    ];

   public function products()
    {
        return $this->hasMany(Product::class, 'CATE_ID', 'ID');
    }
}
