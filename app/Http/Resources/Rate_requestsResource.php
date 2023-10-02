<?php

namespace App\Http\Resources;
use App\Models\RateRequest;


use Illuminate\Http\Resources\Json\JsonResource;

class Rate_requestsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? '',
             'email' => $this->email ?? '',
            'address' => $this->address ?? '',
            'mobile' => $this->mobile ?? '',
            'notes' => $this->notes ?? '',


        ];
    }
}
