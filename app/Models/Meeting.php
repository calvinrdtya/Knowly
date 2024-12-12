<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject', 'name');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'meeting_user');
    }
}
