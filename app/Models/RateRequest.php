<?php

namespace App\Models;

use App\Helpers\Constants;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RateRequest extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'notes',
        'real_estate_details',
        'entity_id',
        'usage_id',
        'type_id',
        'goal_id',
        'real_estate_age',
        'real_estate_area',
        'status',
        'request_no',
        'longitude',
        'latitude',
        'location'
    ];


    public function usage()
    {
        return $this->belongsTo(Category::class, 'usage_id');
    }

    public function goal()
    {
        return $this->belongsTo(Category::class, 'goal_id');
    }


    public function entity()
    {
        return $this->belongsTo(Category::class, 'entity_id');
    }


    public function type()
    {
        return $this->belongsTo(Category::class, 'type_id');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

public function getStatusSpanAttribute()
    {
        if ($this->status == 0) {
            return "<span class='badge badge-pill alert-table badge-warning'>".
            __('admin.NewRequest')."</span>";
        } elseif ($this->status == 1) {
            return "<span class='badge badge-pill alert-table badge-info'>".
            __('admin.NewWorkRequest')."</span>";
        } elseif ($this->status == 2) {
            return "<span class='badge badge-pill alert-table badge-danger'>".
            __('admin.InEvaluationRequest')."</span>";
        } elseif ($this->status == 3) {
            return "<span class='badge badge-pill alert-table badge-success'>".
            __('admin.CheckedRequest')."</span>";
        }
        elseif ($this->status == 4) {
            return "<span class='badge badge-pill alert-table badge-danger'>".
            __('admin.SuspendedRequest')."</span>";
        }

        //
    }
    
    
    public function getStatusApi()
    {
        if ($this->status == 0) {
            return 
            __('admin.NewRequest');
        } elseif ($this->status == 1) {
            return 
            __('admin.NewWorkRequest');
        } elseif ($this->status == 2) {
            return
            __('admin.InEvaluationRequest');
        } elseif ($this->status == 3) {
            return 
            __('admin.CheckedRequest');
        }
        elseif ($this->status == 4) {
            return 
            __('admin.SuspendedRequest');
        }

        //
    }

    public function scopeRefused($query)
    {
        return $query->where('status', Constants::RefusedRequest);
    }

    public function scopePending($query)
    {
        return $query->where('status', Constants::PendingRequest);
    }

    public function scopeInReview($query)
    {
        return $query->where('status', Constants::InReviewRequest);
    }

    public function scopeContacted($query)
    {
        return $query->where('status', Constants::ContactedRequest);
    }


    public function dateFormatted($format = 'M d, Y', $filedDate = 'created_at', $showTimes = false)
    {
        if ($showTimes) {
            $format = $format . ' @ h:i a';
        }
        setLocale(LC_ALL, 'ar_EG.utf-8');
        return date($format, strtotime($this->$filedDate));
    }

        // 'instrument_image',
        // 'construction_license',
        // 'other_contracts',
    public function getOtherImagesAttribute()
    {
         $images = [];
         $files = $this->getMedia('other_contracts');
         if (!empty($files)) {
             foreach ($files as $file) {
                 array_push($images, $file->getFullUrl());
             }
         }

         return $images;
     }

    public function getInstrumentImagesAttribute()
    {
         $images = [];
         $files = $this->getMedia('instrument_image');
         if (!empty($files)) {
             foreach ($files as $file) {
                 array_push($images, $file->getFullUrl());
             }
         }

         return $images;
     }

    public function getConstructionImagesAttribute()
    {
         $images = [];
         $files = $this->getMedia('construction_license');
         if (!empty($files)) {
            foreach ($files as $file) {
                 array_push($images, $file->getFullUrl());
            }
         }

         return $images;
     }

}
