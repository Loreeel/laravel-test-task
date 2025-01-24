<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use Carbon\Carbon;

class CommentResource extends JsonResource
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
            'content' => $this->content,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'product_name' => $this->product->name,
            'user_name' => $this->user->name,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s') ,
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') ,
        ];
    }
}
