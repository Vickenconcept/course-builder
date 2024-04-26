<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background-color: #ddd; font-family: Arial, sans-serif;">

    <div style="background-color: #fff; max-width: 600px; margin: 0 auto; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333;">Hello! welcome</h2>
        <p style="color: #555;">This is your password:</p>
        <p style="color: #00f; font-size: 24px; font-weight: bold;">{{ $password }}</p>

        <p style="color: #555;">You can use this password to log in to your account.</p>

        <p style="color: #777;">Thank you!</p>

        <p><a href="{{ route('home') }}">Link</a></p>
        <p>from: <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a></p>
    </div>

</body>
</html>