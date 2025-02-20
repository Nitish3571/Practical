<x-mail::message>
Hello {{$user->first_name }},

Your account has been created successfully.

**Here is your login information:**<br>
Email: {{ $user->email }} <br>
Password: {{ $password }}

Please verify your details.

<x-mail::button url="{{ route('verification', $user->id) }}">
    verification
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
