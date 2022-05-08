@component('mail::message')

{{ $details['title'] }}

<h3 style="color: #3b7ddd; font-size:20px">Congratulations! </h3>
Your {{ $details['course_name'] }} course enroll request has been approved. Now you can access all the video from {{ $details['course_name'] }} course.

Thanks,<br>
Touhid Physics Academic and Admission Care
@endcomponent