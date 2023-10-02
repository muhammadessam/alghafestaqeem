<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'phone' => $this->phone ?? '',
            'email' => $this->email ?? '',
            'facebook' => $this->facebook ?? '',
            'twitter' => $this->twitter ?? '',
            'instagram' => $this->instagram ?? '',
            'linkedIn' => $this->linkedIn ?? '',
            'youTube' => $this->youTube ?? '',
            'snapchat' => $this->snapchat ?? '',
            'telegram' => $this->telegram ?? '',
            'whats_app' => $this->whats_app ?? '',
            'about' => $this->about ?? '',
            'footer' => $this->footer ?? '',
            'title' => $this->title ?? '',

            'service' => $this->service ?? '',
            'objective' => $this->objective ?? '',
            'slider' => $this->slider ?? '',
            'about_image' => $this->imagePath('about_image') ?? '',
            'slider_image' => $this->imagePath('slider_image') ?? '',
            'objective_image' => $this->imagePath('objective_image') ?? '',
        ];
    }
}