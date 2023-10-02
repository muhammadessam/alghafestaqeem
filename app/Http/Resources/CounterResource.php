<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CounterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ?? '',
            'sign' => $this->sign ?? '',
            'counter' => $this->counter ?? '',

        ];
    }
}