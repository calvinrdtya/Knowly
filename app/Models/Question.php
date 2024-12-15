<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    const TYPE_MULTIPLE_CHOICE = 'multiple_choice';
    const TYPE_SHORT_ANSWER = 'short_answer';
    protected $fillable = ['quiz_id', 'question', 'type'];

    public static function getAllowedTypes()
    {
        return [self::TYPE_MULTIPLE_CHOICE, self::TYPE_SHORT_ANSWER];
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}