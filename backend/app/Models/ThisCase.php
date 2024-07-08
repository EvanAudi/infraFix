<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThisCase extends Model
{
    use HasFactory;
    protected $table = 'case';

    public function milestone_details(){
        $this->hasMany(MilestoneDetail::class);
    }
}
