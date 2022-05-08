<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAcceass extends Model
{
    use HasFactory;

    // relation with student and course
    function CourseStudent(){
        return $this->hasOne(User::class,'id','student_id');
    }
    function CourseName(){
        return $this->hasOne(CourseName::class,'id','course_id');
    }
}
