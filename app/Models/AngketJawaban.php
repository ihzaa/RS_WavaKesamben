<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AngketJawaban extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function jawabanPengguna()
    {
        return $this->hasMany(AngketJawabanPengguna::class);
    }
}
