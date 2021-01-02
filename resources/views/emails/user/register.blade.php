@component('mail::message')
# Welcome

Hi, welcome your cama account created.<br>
Login detail:<br>
password : {{$random_pass}}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
