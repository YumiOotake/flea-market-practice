<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'item' => new ItemResource($this->item),
            'order_status' => $this->status_label,
            'is_reviewed' => $this->review !== null, //購入で使う、レビュー済みか
            'can_ship' => $this->status === 1, //販売で使う、発送可能か
        ];
    }
}
