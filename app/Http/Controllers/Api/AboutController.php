<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Services\FATWA;
use App\Http\Resources\SettingResource;

class AboutController extends ResponseController
{
    public function index()
    {
        $data = Setting::first();

        return $this->successResponse(
            ['setting' => new SettingResource($data)],
            'Done',
            200
        );
    }
}