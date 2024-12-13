<?php

namespace App\Models;

use App\User;
use Eloquent;

class Section extends Eloquent
{
    protected $fillable = ['name', 'my_class_id', 'active', 'teacher_id'];

    public function myClass()
    {
        return $this->belongsTo(MyClass::class, 'my_class_id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function student_record()
    {
        return $this->hasMany(StudentRecord::class);
    }
     public function class()
    {
        return $this->belongsTo(MyClass::class, 'my_class_id'); // Foreign key adalah my_class_id
    }
}
