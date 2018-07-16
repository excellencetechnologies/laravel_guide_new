<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    </head>
    <body>

        <div class="container">
            <h1>User Form</h1>
            <form action="{{ action('UserController@store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="firstname">FirstName</label>
                    <input type="text" class="form-control" name="firstname" placeholder="FirstName">
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Lastname">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </form>
        </div>

    </body>
</html>
