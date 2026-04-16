<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'item_status' => $this->status_label,
            'order_status_label' => $this->order?->status_label,
            'category_name' => $this->category->name,
            'condition_name' => $this->condition->name,
            'favorites_count' => $this->favoritedBy->count(),
        ];
    }
}
