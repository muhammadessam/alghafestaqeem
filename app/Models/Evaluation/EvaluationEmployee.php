<?php

namespace App\Models\Evaluation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class EvaluationEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'position',
        'active',

    ];
    
     public function Transactionpreviewer()
    {
        return $this->hasMany(EvaluationTransaction::class, 'previewer_id');
    }

    public function Transactionincome()
    {
        return $this->hasMany(EvaluationTransaction::class, 'income_id');
    }

    public function Transactionreview()
    {
        return $this->hasMany(EvaluationTransaction::class, 'review_id');
    }
    
}
