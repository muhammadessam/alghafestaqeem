<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'facebook',
        'twitter',
        'instagram',
        'linkedIn',
        'youTube',
        'snapchat',
        'mobile',
        'email',
        'whats_app',
        'telegram',
        'page_background',
        'logo',
        'logo_white',
        'appStore',
        'googlePlay',
        'title',
        'about',
        'footer',
        'service',
        'objective',
        'header',
        'slider',
        'address',
        'favicon',
        'slider_image',
        'objective_image',
        'about_image',
        'appStore',
        'googlePlay'
    ];

    public function imagePath($column)
    {
        $value = '';
        if ($this->{$column} != '') {
            $value = '/' . $this->{$column};
        }

        return $value;
    }
}
