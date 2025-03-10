<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'price' => $this->price,
            'name' => $this->name,
            'description' => $this->description,            
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            'amount' => $this->whenPivotLoaded('product_sale', function () {
                return $this->pivot->amount;
            }),
        ];
    }
}
