<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; 
    
    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'product_id',
        'item_id',
        'cart_id',
        'order_status',
        'item_image',
    ];
    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity', 'price');
    }
}
