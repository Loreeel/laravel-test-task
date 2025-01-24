<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use Carbon\Carbon;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'title' => $this->title,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s') ,
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') ,
        ];
    }
}
