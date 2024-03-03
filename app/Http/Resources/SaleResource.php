<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ProductResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
    // }



    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'products' => ProductResource::collection($this->products),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
