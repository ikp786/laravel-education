<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Topic extends Model
{   
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',       
        'status',
        'subject_id'
    ];

    public function subject()
    {
        // echo 'dfd';die;
        return $this->belongsTo(Subject::class);
    }
}
