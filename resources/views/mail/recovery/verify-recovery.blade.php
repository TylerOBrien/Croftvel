@component('mail::message')
# Recover Account

We received a recovery request for your account.

The identity id is {{ $identity->id }}.

Your secret code is {{ implode('-', str_split($plaintext_code, 3)) }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
