<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTopic extends Model
{
    use HasFactory;
    protected $guarded=[];

    // ralation with course name table
    function CrsName(){
        return $this->hasOne(CourseName::class , 'id' , 'course_name_id');
    }
}
