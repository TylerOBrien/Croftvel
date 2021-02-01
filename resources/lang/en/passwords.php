<?php

return [

    'forgot' => [
        'succeeded' => 'Password reset instructions have been delivered to your email.',
        'failed' => 'Something went wrong. Please try again later.',
        'throttled' => 'Too many forgot password attempts. Please try again later.',
        'invalid-user' => 'An account with this email address does not exist.'
    ],

    'reset' => [
        'succeeded' => 'Your password has been changed.',
        'failed' => 'Failed to reset password.',
        'invalid-user' => 'The email and token don\'t match our records.',
        'invalid-token' => 'Reset token is invalid or has expired.'
    ],

];
