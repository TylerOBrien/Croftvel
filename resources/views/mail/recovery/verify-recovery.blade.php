@component('mail::message')
# Recover Account

We received a recovery request for your account.

The identity id is {{ $recovery->identity->id }}.

Your secret code is {{ $plaintext_code }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
