<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Interfaces\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
    public function getImagesSettings()
    {
        return [
            'page_background',
            'logo',
            'logo_white',
            'slider_image',
            'objective_image',
            'about_image'
        ];
    }

    public function getFirstSettings()
    {
        return Setting::first();
    }

    public function updateSetting($settingId, $newDetails)
    {
        return Setting::find($settingId)->update($newDetails);
    }
}