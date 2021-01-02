@component('mail::message')
# Password Reset

Hi, Your password has been resetted kindly login with following password.<br>
Password : {{$password }}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
