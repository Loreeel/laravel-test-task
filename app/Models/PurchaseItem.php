<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Purchase;
use App\Models\Product;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'price', 'purchase_id', 'product_id', 'total'];

     public function purchase()
     {
         return $this->belongsTo(Purchase::class);
     }
 
     public function product()
     {
         return $this->belongsTo(Product::class);
     }
}
