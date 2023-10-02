<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title ?? '',
            'image' => $this->image ?? '',
            'mobile' => $this->mobile ?? '',
            'whats_app' => $this->whats_app ?? '',
            'link' => $this->link ?? '',
            'email' => $this->email ?? '',
        ];
    }
}