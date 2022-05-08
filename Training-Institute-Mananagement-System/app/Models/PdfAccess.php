<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfAccess extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    // relation with pdf and user
    function PDF(){
        return $this->hasOne(Pdf::class,'id','pdf_id');
    }
    function PdfStudent(){
        return $this->hasOne(User::class,'id','student_id');
    }
    function PdfCourse(){
        return $this->hasOne(CourseName::class,'id','course_id');
    }
}
