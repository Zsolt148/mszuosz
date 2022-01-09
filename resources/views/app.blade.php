<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Magyar Szenior Úszók Országos Szövetsége</title>

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Primary Meta Tags -->
        <title>Magyar Szenior Úszók Országos Szövetsége</title>
        <meta name="title" content="Magyar Szenior Úszók Országos Szövetsége">
        <meta name="description" content="Magyar Szenior Úszók Országos Szövetsége">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://mszuosz.hu/">
        <meta property="og:title" content="Magyar Szenior Úszók Országos Szövetsége">
        <meta property="og:description" content="Magyar Szenior Úszók Országos Szövetsége">
        <meta property="og:image" content="https://mszuosz.hu/images/mszuosz_logo.jpg">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://mszuosz.hu/">
        <meta property="twitter:title" content="Magyar Szenior Úszók Országos Szövetsége">
        <meta property="twitter:description" content="Magyar Szenior Úszók Országos Szövetsége">
        <meta property="twitter:image" content="https://mszuosz.hu/images/mszuosz_logo.jpg">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-K3Y4KGZHC8"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-K3Y4KGZHC8');
        </script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('/js/manifest.js') }}" defer></script>
        <script src="{{ mix('/js/vendor.js') }}" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
