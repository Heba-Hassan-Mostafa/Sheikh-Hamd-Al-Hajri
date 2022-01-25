@component('mail::message')
{{-- # Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}
<h2>Hello Admin,</h2>
You received an email from : {{ $name }}
Here are the details:
<b>Name:</b> {{ $name }}
<b>Email:</b> {{ $email }}
<b>Message:</b> {{ $message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
