<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
</head>
<body>
    <h1>Welcome To Our Application</h1>
    <p>Dear : {{$name}}</p>
    <p>Thank You For Reaching Our Contact</p>
    <p>Regards,</p>
    <h4>{{env('APP_NAME')}}</h4>
    
</body>
</html>