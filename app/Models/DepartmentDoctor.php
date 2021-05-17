<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentDoctor extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function schedule()
    {
        return $this->hasMany(DoctorSchedule::class);
    }
}
