<?php

namespace App\Models;

use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Privacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'privacy_en',
        'privacy_ar',
        

    ];


}