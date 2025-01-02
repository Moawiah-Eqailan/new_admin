<?php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_amount', 'status', 'payment_method'];

   
    public function items()
{
    return $this->hasMany(Item::class);
}
}
