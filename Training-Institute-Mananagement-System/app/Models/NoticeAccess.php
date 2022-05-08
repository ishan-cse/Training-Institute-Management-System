<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeAccess extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation with student and course
    function NoticeStudent(){
        return $this->hasOne(User::class,'id','student_id');
    }
    function NoticeCourse(){
        return $this->hasOne(CourseName::class,'id','course_id');
    }
    function Notices(){
        return $this->hasOne(Notice::class,'id','notice_id');
    }
}
