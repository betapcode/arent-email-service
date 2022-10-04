<?php

namespace Arent\SendMail\Http\Resources\Ghost;

use Illuminate\Http\Resources\Json\JsonResource;

class EmptyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [];
    }
}