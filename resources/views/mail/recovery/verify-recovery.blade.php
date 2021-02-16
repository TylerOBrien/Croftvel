@component('mail::message')
# Recover Account

We received a recovery request for your account.

Your secret code is {{ $plaintext_code }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
