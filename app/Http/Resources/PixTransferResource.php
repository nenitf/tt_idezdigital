<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PixTransferResource extends JsonResource
{
    public static $wrap = null;

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
            'user_id' => $this->user_id,
            'key' => $this->key,
            'amount' => $this->amount,
            'description' => $this->description,
        ];
    }
}
