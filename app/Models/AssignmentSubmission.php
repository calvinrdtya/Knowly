<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id', 
        'student_id', 
        'notes', 
        'file_path', 
        'submitted_at',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student_record()
    {
        return $this->belongsTo(StudentRecord::class, 'student_id');
    }
}
