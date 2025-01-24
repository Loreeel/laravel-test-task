<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
// use App\Models\PurchaseItem;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['total_amount', 'user_id'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
