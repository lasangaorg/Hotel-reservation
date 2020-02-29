<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
{{--        <div class="flex-center position-ref full-height">--}}
{{--            @if (Route::has('login'))--}}
{{--                <div class="top-right links">--}}
{{--                    @auth--}}
{{--                        <a href="{{ url('/home') }}">Home</a>--}}
{{--                    @else--}}
{{--                        <a href="{{ route('login') }}">Login</a>--}}

{{--                        @if (Route::has('register'))--}}
{{--                            <a href="{{ route('register') }}">Register</a>--}}
{{--                        @endif--}}
{{--                    @endauth--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}

<div>
    <header>
        <div class="overlay"></div>
        <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
            <source src="https://storage.googleapis.com/coverr-main/mp4/Holiday Resort.mp4" type="video/mp4">
        </video>
        <div class="container h-100">
            <ul class="nav justify-content-end">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
            <div class="d-flex h-100 text-center align-items-center">
                <div class="w-100 text-white">
                    <h1 class="display-3">Holiday CheckIN</h1>
                    <p class="lead mb-0">Find your holiday stay</p>
                </div>
            </div>
        </div>
    </header>

    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <p>The HTML5 video element uses an mp4 video as a source. Change the source video to add in your own
                        background! The header text is vertically centered using flex utilities that are build into
                        Bootstrap 4.</p>
                    <p>The overlay color can be changed by changing the <code>background-color</code> of the <code>.overlay</code>
                        class in the CSS.</p>
                    <p>Set the mobile fallback image in the CSS by changing the background image of the header element
                        within the media query at the bottom of the CSS snippet.</p>
                    <p class="mb-0">
                        Created by <a href="https://startbootstrap.com">Start Bootstrap</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>
