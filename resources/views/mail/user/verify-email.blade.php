@component('mail::message')
# Hello, {{ $user->first_name }}

You must verify your email address to use the app.

Your verification code is: {{ $code }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
