<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'item_name',
        'item_description',
        'item_price',
        'item_image',
        'product_id',
        'category_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'item_id', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'item_id', 'user_id');
    }
}
