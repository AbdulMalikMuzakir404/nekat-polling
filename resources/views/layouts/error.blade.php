<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('error/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('error/assets/css/pages/error.css') }}">
    <link rel="shortcut icon" href="{{ asset('error/assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('error/assets/images/logo/favicon.png') }}" type="image/png">
</head>

<body>
    <div id="error">
        <div class="error-page container">
            @yield('error')
        </div>
    </div>
</body>

</html>
