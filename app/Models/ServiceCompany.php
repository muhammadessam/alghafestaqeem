<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCompany extends Model
{
    use HasFactory;
    protected $fillable = ['service_id','company_id'];
}