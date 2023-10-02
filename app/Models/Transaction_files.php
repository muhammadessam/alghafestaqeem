<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_files extends Model
{
    use HasFactory;
    protected $fillable = [
        'Transaction_id',
        'path',
        'type',
    ];
   

    

}