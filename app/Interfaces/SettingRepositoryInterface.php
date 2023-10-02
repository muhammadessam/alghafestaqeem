<?php

namespace App\Interfaces;

interface SettingRepositoryInterface
{
    public function getImagesSettings();
    public function getFirstSettings();
    public function updateSetting($settingId, $newDetails);
}