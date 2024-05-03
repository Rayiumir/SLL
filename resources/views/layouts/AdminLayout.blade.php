<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> میزکار {{$title ?? ''}}</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/toaster.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @livewireStyles
    {{ $styles ?? '' }}
</head>
<body>
    <div class="d-flex" id="wrapper">
        @include('layouts.inc.sidebar')
        <!-- Page Content -->
        <div id="page-content-wrapper">
            @include('layouts.inc.navbar')
            <main class="container">
                <div class="mt-3">
                    {{$slot}}
                </div>
            </main>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Menu Toggle Script -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/toaster.min.js')}}"></script>

    <script>
        @if(Session::has('message'))
            toastr.options =
            {
                "progressBar" : true
            }
        toastr.success("{{ session('message') }}");
        @endif

            @if(Session::has('error'))
            toastr.options =
            {
                "progressBar" : true
            }
        toastr.error("{{ session('error') }}");
        @endif

            @if(Session::has('info'))
            toastr.options =
            {
                "progressBar" : true
            }
        toastr.info("{{ session('info') }}");
        @endif

            @if(Session::has('warning'))
            toastr.options =
            {
                "progressBar" : true
            }
        toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    @livewireScripts
    {{ $scripts ?? '' }}
</body>
</html>
