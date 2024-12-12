<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function student_record()
    {
        return $this->belongsTo(StudentRecord::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }
}
