<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyVault Savings Admin</title>
    <link rel="icon" href="{{asset('icon.png')}}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
        <script src="https://unpkg.com/@phosphor-icons/web"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#F8F8F8]">
    <div id="app">
        <router-view></router-view>
    </div>
    @vite('resources/js/app.js')
</body>

</html>
