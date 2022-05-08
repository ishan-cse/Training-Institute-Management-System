@component('mail::message')

{{ $details['title'] }}

<span style="color: #28a745">Congratulations! Your account has been approved.</span><br/>
<h3 style="color: #3b7ddd; font-size:20px">Your student id is {{ $details['student_id'] }}</h3>
<span class="text-success">You can login now with this student id </span>
@component('mail::button', ['url' => $details['url']])
Login
@endcomponent

Thanks,<br>
Touhid Physics Academic and Admission Care
@endcomponent