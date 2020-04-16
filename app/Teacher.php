<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'firstName', 'lastName', 'user_id'
    ];
    
    public function image()
    {
        return $this->hasMany(Image::class);
    }
    public function gradebook()
    {
        return $this->hasOne(Gradebook::class);
    }
}
