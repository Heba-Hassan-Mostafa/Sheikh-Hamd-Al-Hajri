@component('mail::message')
# Hello!

# {{$client->name}} 

You are receiving this email because we received a password reset request for your account.
<br>

# Your reset code is : {{$client->pin_code}} 

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}
<br>
If you did not request a password reset, no further action is required.
<br>
Regards,<br>
{{ config('app.name') }}
@endcomponent
