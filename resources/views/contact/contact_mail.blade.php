@component('mail::message')
# Contact Form Submission

**Name:** {{$data['name']}}

**Email:** {{$data['email']}}

**Phone Number:** {{$data['phone']}}

**Subject:** {{$data['subject']}}

**Message:** 
<br>
{{$data['message']}}
<br><br>
Thanks, <br>
{{config('app.name')}}
@endcomponent