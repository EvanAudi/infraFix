<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilestoneDetail extends Model
{
    use HasFactory;
    protected $table = 'milestone_detail';
    protected $fillable =[
        'milestone_id',
        'case_id',
        'description'
    ];

}
