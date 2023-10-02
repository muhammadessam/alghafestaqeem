<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrivacyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'privacy_en' => $this->privacy_en ?? '',
            'privacy_ar' => $this->privacy_ar ?? '',
            
        ];
    }
}