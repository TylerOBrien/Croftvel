@component('mail::message')
# Reset Your Password

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $url ])
Reset Password
@endcomponent

This password reset link will expire in {{ $ttl }} {{ $ttl_type }}.

If you did not request a password reset, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
