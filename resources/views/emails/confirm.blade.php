<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>sign up confirm URL</title>
</head>
<body>
    <h1>thanks for your registration ~ mew</h1>

    <p>
        please click the link below to complete the registration ~ mew
        <a href="{{ route('confirm_email', $user->activation_token) }}">
            {{ route('confirm_email', $user->activation_token) }}
        </a>
    </p>

    <p>if this isn't your opration, please ignore this email ~ mew</p>
</body>
</html>