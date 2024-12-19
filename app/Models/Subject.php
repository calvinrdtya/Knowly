<?php

namespace App\Models;

use App\User;
use Eloquent;

class Subject extends Eloquent
{
    protected $table = 'subjects';
    protected $fillable = ['name', 'slug', 'my_class_id', 'teacher_id', 'hari', 'jam_mulai', 'jam_selesai'];

    public function my_class()
    {
        return $this->belongsTo(MyClass::class, 'class_id', 'id');
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
