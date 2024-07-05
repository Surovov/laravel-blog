<!-- resources/views/emails/verify.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>
<body>
    <h1>Thank you for subscribing!</h1>
    <p>Please verify your email by clicking the link below:</p>
    <a href="{{ url('verify/'.$subs->token) }}">Verify Email</a>
</body>
</html>
