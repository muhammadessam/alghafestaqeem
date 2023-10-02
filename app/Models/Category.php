<?php

namespace App\Models;

use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'position',
        'active',

    ];


    public function scopeApartmentGoal($query)
    {
        return $query->where('type', Constants::ApartmentGoal);
    }

    public function scopeApartmentType($query)
    {
        return $query->where('type', Constants::ApartmentType);
    }

    public function scopeApartmentEntity($query)
    {
        return $query->where('type', Constants::ApartmentEntity);
    }

    public function scopeApartmentUsage($query)
    {
        return $query->where('type', Constants::ApartmentUsage);
    }
    
    public function scopeCity($query)
    {
        return $query->where('type', Constants::CityType);
    }

}
