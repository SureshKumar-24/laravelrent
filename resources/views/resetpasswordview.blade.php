<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rest Password</title>
</head>

<body>
    <form method="POST" action="{{'/api'}}/resetpassword">
        @csrf
        <input type="hidden" name="id" value="{{$user[0]['id']}}">
        <input type="password" name="password" placeholder="New Password">
        <br><br>
        <input type="password" name="password_confirmation" placeholder="Confirm Password">
        <br><br>
        <button type="submit">Submit</button>
    </form>
</body>

</html>