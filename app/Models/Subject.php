<?php

namespace App\Models;

use App\User;
use Eloquent;

class Subject extends Eloquent
{
    protected $fillable = ['name', 'my_class_id', 'teacher_id', 'slug'];

    public function my_class()
    {
        return $this->belongsTo(MyClass::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->hasMany(StudentRecord::class, 'subject_id');
    }
    public function attendances(){
        return $this->hasMany(Attendance::class, 'subject_id');
    }
}
