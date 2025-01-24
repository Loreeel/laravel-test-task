<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use Carbon\Carbon;

class PurchaseItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total' => $this->total,
            // 'purchase_id' => $this->purchase_id,
            'product_id' => $this->product_id,
            'product_name' => $this->product ? $this->product->name : null, 
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s') ,
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') ,
        ];
    }
}
