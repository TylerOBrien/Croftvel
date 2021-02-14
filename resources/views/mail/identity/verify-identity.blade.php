@component('mail::message')
# Verify Identity

@if ($user->full_name)
  Hello, {{ $user->full_name }}.
@else
  Hello.
@endif

Please verify you are the owner of this email address.

Your secret verification code is {{ chunk_split($plaintext_code, 3, '—') }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
