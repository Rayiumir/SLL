<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> صفحه اصلی {{$title ?? ''}}</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.rtl.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/all.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        {{ $styles ?? '' }}
    </head>
    <body>
        <main class="container">
            <div class="mt-3">
                {{$slot}}
            </div>
        </main>
    </body>
</html>
