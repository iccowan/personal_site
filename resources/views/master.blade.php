<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- Meta Tags --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Ian Cowan">
        <meta name="title" content="Ian Cowan's Personal Website">

        {{-- Scripts --}}
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
        <script type="text/javascript" src="/js/app.js"></script>

        {{-- Style Sheets --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/app.css">

        {{-- Page Title --}}
        <title>
            @yield("title") | Ian Cowan
        </title>
    </head>
    <body>
        <div class="page-container">
            <div class="content-wrap">
                @include("inc.navbar")
                <br />
                @yield("content")
            </div>
            @include("inc.footer")
        </div>
    </body>
</html>
