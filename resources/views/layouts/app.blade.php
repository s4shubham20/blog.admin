<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @isset($setting)
    <link rel="shortcut icon" href="{{ $setting !=  null ? $setting->fevicon :'' }}">
    @endisset
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @isset($meta)
    {{-- Meta Details here --}}
    <title>{{ $meta['metatitle'] }}</title>
    <meta name="description" content="{{ $meta['metadescription'] }}">
    <meta name="keywords" content="{{ $meta['metakeyword'] }}">
    @endisset
    @if(isset($setting))

    <meta name="robots" content="{{ $setting->robot == 1 ? 'index, follow' : 'no index, no follow' }}"/>
    <meta name="googlebot" content="{{ $setting->robot == 1 ? 'index, follow' : 'no index, no follow' }}"/>
    <meta name="bingbot" content="{{ $setting->robot == 1 ? 'index, follow' : 'no index, no follow' }}"/>
    <link rel="canonical" href="{{ $setting->url }}" />
    @endif
    {{-- css  --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/back/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/back/css/custom.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/owlcarousel/owl.theme.default.min.css') }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    @yield('css')
    <style>
        .radius-bd {
            border-radius: 20px
        }
        .ordered .ul-inline .list-unstyled{
            display: inline;
            list-style-type: none;
            margin-inline: 10px;
        }
        .ordered .ul-inline .list-unstyled a{
            text-decoration: none;
        }
        .ordered .ul-inline .list-unstyled a:hover{
            cursor: pointer;
        }
        .owl-carousel .owl-dots.disabled, .owl-carousel .owl-nav.disabled{
            display: block;
        }
        .owl-nav button.owl-next,
        .owl-nav button.owl-prev{
            color: #fff !important;
            margin-left: 10px;
            background-color: orange !important;
            border: none;
            outline: none;
            font-size: 20px;
            height: 28px;
            width: 38px;
        }
        .underline {
            height: 3px;
            width: 60px;
            background-color: red;
            margin-bottom: 10px;
        }
    </style>
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body>
    <div id="app">
        @if(!(Request::is('login') OR Request::is('register')))
        @include('layouts.include.front.header')
        @endif
        <main>
            @yield('content')
        </main>
        @if(!(Request::is('login') OR Request::is('register')))
        @include('layouts.include.front.footer')
        @endif
        <script src="{{ asset('assets/back/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/back/js/scripts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
        <script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/front/js/owlcarousel/owl.carousel.min.js') }}"></script>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#form").submit(function() {
            var email = $("#newsletter").val();
            //alert(email);
            $.ajax({
                url: "{{ route('newsletter') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    email: email
                },
                success: function(response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Thank you for subscribe our newsletter !',
                        showConfirmButton: false,
                        timer: 6000
                    });
                    $('#form')[0].reset();
                },
                error: function(response) {
                    // Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'error',
                    //     title: 'Your email id is already registered with us !',
                    //     showConfirmButton: false,
                    //     timer: 6000
                    // });
                    $('#emailErrorMsg').text(response.responseJSON.errors.email);
                }
            });
            event.preventDefault();
        });
    })
</script>
<script>
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })
</script>
</html>
