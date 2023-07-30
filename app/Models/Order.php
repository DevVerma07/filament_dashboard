<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_name', 'customer_email', 'quantity'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    // public function products()
    // {
    //     return $this->belongsToMany(Product::class)->withPivot('quantity');
    // }
}
