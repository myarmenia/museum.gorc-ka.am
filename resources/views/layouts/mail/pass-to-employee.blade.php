<!DOCTYPE html>
<html>
<head>
    <title>Բարի գալուստ Museum</title>
</head>
<body>

   <p>Lorem ipsuum,</p>

    <p>Link</p>

    <p>Yor pass: {{$data['password']}}</p>
    <p>Yor email: {{$data['email']}}</p>
    <p> <a href="{{env('BASE_CLIENT_URL').session('languages').'/login/'}}">Link to login</a></p>
   <p> Welcome to the Team!</p>
   <p> Webex </p>
</body>
</html>
