<!DOCTYPE html>
<html lang="pt-br" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Site Exemplo Pagarme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ url(mix('site/assets/css/app.css')) }}">
    
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
    @include('site.includes.header')
    <div class="container">
        @yield('content')
    </div>
    @include('site.includes.footer')

    <script src="{{ url(mix('site/assets/js/app.js')) }}"></script>
    @yield('js')
</body>
</html>
