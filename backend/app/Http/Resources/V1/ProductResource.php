<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

use Carbon\Carbon;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->when(Route::currentRouteName() == 'products.show', $this->description),
            'price' => $this->price,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'category_name' => $this->category->title,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s') ,
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') ,
        ];
        
    }
}
// 