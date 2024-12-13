<?php

namespace App\Models;

use Eloquent;

class MyClass extends Eloquent
{
    protected $fillable = ['name', 'class_type_id'];

    public function section()
    {
        return $this->hasMany(Section::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class, 'my_class_id');
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class, 'my_class_id');
    }
    public function class_type()
    {
        return $this->belongsTo(ClassType::class);
    }

    public function student_record()
    {
        return $this->hasMany(StudentRecord::class);
    }
}
