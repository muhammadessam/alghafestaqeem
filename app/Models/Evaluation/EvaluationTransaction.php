<?php

namespace App\Models\Evaluation;

use App\Models\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transaction_files;


class EvaluationTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation_company_id',
        'evaluation_employee_id',
        'instrument_number',
        'transaction_number',
        'is_iterated',
        'date',
        'owner_name',
        'type_id',
        'region',
        'previewer_id',
        'review_id',
        'income_id',
        'city_id',
        'notes',
        'status',
         'review_fundoms',
          'company_fundoms',
          'phone',
    ];


    public function getStatusSpanAttribute()
    {
        if ($this->status == 0) {
            return "<span class='badge badge-pill alert-table badge-warning'>".
            __('admin.NewTransaction')."</span>";
        } elseif ($this->status == 1) {
            return "<span class='badge badge-pill alert-table badge-info'>".
            __('admin.InReviewRequest')."</span>";
        } elseif ($this->status == 2) {
            return "<span class='badge badge-pill alert-table badge-primary'>".
            __('admin.ContactedRequest')."</span>";
        } elseif ($this->status == 3) {
            return "<span class='badge badge-pill alert-table badge-danger'>".
            __('admin.ReviewedRequest')."</span>";
        }elseif ($this->status == 4) {
            return "<span class='badge badge-pill alert-table badge-success'>".
            __('admin.FinishedRequest')."</span>";
        }elseif ($this->status == 5) {
            return "<span class='badge badge-pill alert-table badge-warning'>".
            __('admin.PendingRequest')."</span>";
        }
        elseif ($this->status == 6) {
            return "<span class='badge badge-pill alert-table badge-warning'>".
            __('admin.Cancelled')."</span>";
        }
    }

    public function type()
    {
        return $this->belongsTo(Category::class, 'type_id');
    }
    
    public function city()
    {
        return $this->belongsTo(Category::class, 'city_id');
    }

    public function company()
    {
        return $this->belongsTo(EvaluationCompany::class, 'evaluation_company_id');
    }

    public function employee()
    {
        return $this->belongsTo(EvaluationEmployee::class, 'evaluation_employee_id');
    }

    public function previewer()
    {
        return $this->belongsTo(EvaluationEmployee::class, 'previewer_id');
    }
       public function files()
    {
        return $this->hasMany(Transaction_files::class ,'Transaction_id','id');

    }

    public function review()
    {
        return $this->belongsTo(EvaluationEmployee::class, 'review_id');
    }

    public function income()
    {
        return $this->belongsTo(EvaluationEmployee::class, 'income_id');
    }


    public function getIteratedSpanAttribute($value)
    {
        if(is_numeric($this->instrument_number))
        {
            if (EvaluationTransaction::where('instrument_number', $this->instrument_number)->count() > 1) {
                $value = "<span class='badge badge-pill badge-danger'> نعم</span>";
            } else {
                $value = "<span class='badge badge-pill badge-success'>لا</span>";
            }

        }
        else
        {
            $value = "<span class='badge badge-pill badge-success'>لا</span>";
        }
        


        return $value;
    }

     public function getIsIteratedAttribute($value)
    {
        if(is_numeric($this->instrument_number))
        {
        
        if (EvaluationTransaction::where('instrument_number', $this->instrument_number)->count() > 1) {
            $value = 1;
        } else {
            $value = 0;
        }
        }
        else
        {
            $value = 0;
        }

        return $value;
    }


}
