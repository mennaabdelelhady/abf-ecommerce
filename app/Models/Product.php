<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_url',
        'brand',
        'category_id',
        'rating',
        'sales_count',
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
}
