<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function gradebook()
    {
        return $this->hasOne(Gradebook::class);
    }
}
