<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id', 
        'subject_id', 
        'class_id', 
        'title', 
        'description', 
        'due_date',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function class()
    {
        return $this->belongsTo(MyClass::class, 'class_id');
    }
    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
