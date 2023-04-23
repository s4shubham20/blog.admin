<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @isset($meta)
    {{-- Meta Details here --}}
    <title>{{ $meta['metatitle'] }}</title>
    <meta name="description" content="{{ $meta['metadescription'] }}">
    <meta name="keywords" content="{{ $meta['metakeyword'] }}">
    @endisset

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/back/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/back/css/custom.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
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
    </style>
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>

<body>
    <div id="app">
        @if(!(Request::is('login') OR Request::is('register')))
        @include('layouts.include.front.header')
        @endif
        <main class="py-4">
            @yield('content')
        </main>
        @if(!(Request::is('login') OR Request::is('register')))
        @include('layouts.include.front.footer')
        @endif
        <script src="{{ asset('assets/back/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/back/js/scripts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
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
</html>
