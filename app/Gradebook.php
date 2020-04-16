<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
