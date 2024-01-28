<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public $timestamps = true;

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('position', 'asc');
    }

    public function scopePublish($query)
    {
        return $query->where('active', 1);
    }

    public function getActiveSpanAttribute($value)
    {
        if ($this->active != 1) {
            $value = "<span class='badge badge-pill badge-warning'> Draft</span>";
        } else {
            $value = "<span class='badge badge-pill badge-success'>Publish</span>";
        }

        return $value;
    }

    public function dateFormatted($format = 'M d, Y', $filedDate = 'created_at', $showTimes = false)
    {
        if ($showTimes) {
            $format = $format . ' @ h:i a';
        }

        return date($format, strtotime($this->$filedDate));
        // return $this->$filedDate->format($format);
    }

    public function getImageAttribute($value)
    {
        if ($value != '') {
            $value = '/' . $value;
        } else {
            $value = '/images/default.png';
        }

        return $value;
    }
}
