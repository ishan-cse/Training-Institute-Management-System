@component('mail::message')

{{ $details['title'] }}

<h3 style="color: #0da2ff; font-size:20px">Your student id is updated. Your new student id is <span style="color:00FF00"> {{ $details['student_id'] }}</h3>


Thanks,<br>
Touhid Physics Academic and Admission Care
@endcomponent