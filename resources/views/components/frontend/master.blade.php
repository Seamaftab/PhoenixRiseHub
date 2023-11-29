<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{$title??'Check the codes, /Frontend/'}}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('ui/frontend/assets/favicon.ico')}}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('ui/frontend/css/styles.css')}}" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <x-frontend.partials.navbar/>
        <!-- Section-->
        <section class="py-5">
            {{$slot}}
        </section>
        <!-- Footer-->
        <x-frontend.partials.footer/>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('ui/frontend/js/scripts.js')}}"></script>
        @stack('script')
    </body>
</html>
