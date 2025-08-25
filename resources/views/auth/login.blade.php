<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Salaires</title>
</head>

<body>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href={{ asset('css/auth.css') }}>
    <form method="post" action="{{ route('handlelogin') }}">

        @csrf
        @method('POST')

        <div class="box">
            <h1>Connexion</h1>


            @if(Session::get('error_msg'))
                <p style="font-size:11px; color: rgba(238, 75, 75, 1);">{{ Session::get('error_msg') }}</p>
            @endif

            <input type="email" name="email" class="email" />

            <input type="password" name="password" class="email" />

            <div class="btn-container">
                <button type="submit"> connexion</button>
            </div>

            <!-- End Btn -->
            <!-- End Btn2 -->
        </div>
        <!-- End Box -->
    </form>

</body>

</html>