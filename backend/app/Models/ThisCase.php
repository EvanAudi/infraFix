<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThisCase extends Model
{
    use HasFactory;
    protected $table = 'cases';
    protected $fillable =[
        'title',
        'description',
        'address',
        'coordinate',
        'kelurahan_id',
        'government_id',
        'created_by',
        'damage_type_id',
        'status',
        'case_number'
    ];

    public function milestone_details(){
        $this->hasMany(MilestoneDetail::class);
    }
}
