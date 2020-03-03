<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">

</head>
<body>
<div>
    @include('cookieConsent::index')
    <header>
        <div class="overlay"></div>
        <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
            <source src="https://storage.googleapis.com/coverr-main/mp4/Holiday Resort.mp4" type="video/mp4">
        </video>
        <div class="container h-100">
            <ul class="nav justify-content-end">
                @if (Route::has('login'))
                    @auth
                        <button class="btn btn-link" style="text-decoration: none; pointer-events: none">
                            Welcome {{ Auth::user()->email }}</button>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link" type="submit">Logout</button>
                        </form>
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
                    <div class="row">
                        <div class="col-12 s003">
                            <form>
                                <div class="inner-form">
                                    <div class="input-field first-wrap">
                                        <div class="input-select">
                                            <select data-trigger="" name="choices-single-defaul">
                                                <option placeholder="">Category</option>
                                                <option>New Arrivals</option>
                                                <option>Sale</option>
                                                <option>Ladies</option>
                                                <option>Men</option>
                                                <option>Clothing</option>
                                                <option>Footwear</option>
                                                <option>Accessories</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-field second-wrap">
                                        <input id="search" type="text" placeholder="Enter Keywords?"/>
                                    </div>
                                    <div class="input-field third-wrap">
                                        <button class="btn-search" type="button">
                                            <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true"
                                                 data-prefix="fas" data-icon="search" role="img"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                      d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

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
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
