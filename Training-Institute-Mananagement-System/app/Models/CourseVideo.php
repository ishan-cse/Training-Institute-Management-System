<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseVideo extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation with course name and course topic table
    function CrsName(){
        return $this->hasOne(CourseName::class , 'id' , 'course_name_id');
    }
    function CrsTopic(){
        return $this->hasOne(CourseTopic::class,'id','course_topic_id');
    }
}
