@component('mail::message')
# Verify Email Address

@if ($recipient->full_name)
  Hello, {{ $recipient->full_name }}.
@else
  Hello.
@endif

Please verify you are the owner of this email address.

Your secret verification code is {{ implode('-', str_split($plaintext_code, 3)) }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
