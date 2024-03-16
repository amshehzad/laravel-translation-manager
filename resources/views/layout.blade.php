<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{app()->getLocale()}}" xml:lang="{{config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <title>{{ $documentTitle ?? 'Translation Manager' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @switch(config('translation-manager.template'))
        @case('bootstrap4')
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
                  integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn"
                  crossorigin="anonymous">
            @break
        @case('bootstrap5')
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
                  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
                  crossorigin="anonymous">
            @break
        @case('tailwind3')
            <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
            <style>
                .form-floating {
                    position: relative;
                }

                .form-floating > label {
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 100%;
                    padding: 1rem 0.75rem;
                    pointer-events: none;
                    border: 1px solid transparent;
                    transform-origin: 0 0;
                    transition: opacity .1s ease-in-out, transform .1s ease-in-out;
                }

                .form-floating > .form-control:focus {
                    padding-top: 1.625rem;
                    padding-bottom: 0.625rem;
                }

                .form-floating > .form-control:focus ~ label {
                    opacity: .65;
                    transform: scale(.85) translateY(-0.5rem) translateX(0.15rem);
                }
            </style>
            <script>
                tailwind.config = {
                    theme: {
                        extend: {
                            colors: {
                                primary: {
                                    50: "#fafafa",
                                    100: "#f5f5f5",
                                    200: "#e5e5e5",
                                    300: "#d4d4d4",
                                    400: "#a3a3a3",
                                    500: "#737373",
                                    600: "#525252",
                                    700: "#404040",
                                    800: "#262626",
                                    900: "#171717"
                                },
                            }
                        }
                    }
                }
            </script>
            @break
        @default
    @endswitch
    @stack('styles')

    @livewireStyles

    <style>
        .d-none {
            display: none !important;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 24px;
            z-index: 10;
        }

        .overlay-fullscreen {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100vw;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
        }

        .overlay::after, .overlay-fullscreen::after {
            content: "";
            width: 75px;
            height: 75px;
            border: 15px solid #dddddd;
            border-top-color: #009578;
            border-radius: 50%;
            animation: loading 0.75s ease infinite;
        }

        @keyframes loading {
            from {
                transform: rotate(0turn);
            }
            to {
                transform: rotate(1turn);
            }
        }


        .translation-editor {
            position: absolute;
            z-index: 1000;
            top: 150%;
            left: 50%;
            transform: translateX(-50%);
            min-width: 25rem;
            width: 100%;
            background-color: #fff;
            color: #fff;
            text-align: center;
            border-radius: 6px;
        }

        .arrow {
            position: absolute;
            display: block;
            border-color: transparent;
            border-style: solid;
            top: -9.9px;
            left: 50%;
            border-width: 11px;
            margin-left: -11px;
            border-bottom-color: rgba(0, 0, 0, .125);
            border-top-width: 0;
            transform: rotate(0deg);

        }

        .arrow::after {
            content: " ";
            top: 1px;
            margin-left: -10px;
            border-width: 10px;
            border-top-width: 0;
            position: absolute;
            display: block;
            border-color: transparent;
            border-bottom-color: #fff !important;
            border-style: solid;
        }

        .empty-translation {
            color: #DD1144 !important;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container body-wrapper mx-auto">
    <h1 class="my-3 h2 text-3xl font-medium">{{ $documentTitle ?? 'Translation Manager' }}</h1>
    @stack('notifications')
    <main id="content-wrapper" class="mb-6">
        @yield('content')

    </main>
</div>
<span class="javascripts">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"
            integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK"
            crossorigin="anonymous"></script>

    @switch(config('translation-manager.template'))
        @case('bootstrap4')
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
                    crossorigin="anonymous"></script>
            @break
        @case('bootstrap5')
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                    crossorigin="anonymous"></script>
            @break
        @default
    @endswitch
    @stack('scripts')
</span>

@livewireScripts
</body>
</html>


