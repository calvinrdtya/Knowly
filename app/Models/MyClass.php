<?php

namespace App\Models;

use App\User;
use Eloquent;

class MyClass extends Eloquent
{
    protected $fillable = ['name', 'class_type_id'];

    public function section()
    {
        return $this->hasMany(Section::class);
    }

    public function class_type()
    {
        return $this->belongsTo(ClassType::class);
    }

    public function student_record()
    {
        return $this->hasMany(StudentRecord::class);
    }

    public function teacher()
    {
        return $this->hasMany(User::class, 'teacher_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
