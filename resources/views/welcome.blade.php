<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css"/>

</head>
<body>
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

    <div class="container">
        <div class="mt-4">
            <span>@if (Route::has('login'))
                    @auth
                        <a href="{{url('post')}}" class="p-0 nav-link">Show my posts</a>
                    @endauth
                @endif
        </span>
        </div>
        <h3>Find your destination</h3>
        <div id="sectionNews" class="row">
            @forelse($posts as $key => $post)
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div id="carouselExampleIndicators{{$key}}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if($post->postImages->count() <= 0)
                                    <div class="carousel-item active">
                                        <img class="d-block w-100"
                                             src="http://placehold.it/700x400?auto=yes&bg=777&fg=555&text=No images to display"
                                             alt="First slide" height="200px" width="100px">
                                    </div>
                                @endif
                                @foreach($post->postImages as $image)
                                    <div
                                        class="carousel-item {{$image->id == $post->postImages[0]->id ? 'active': ''}}">
                                        <img class="d-block w-100"
                                             src="data:image/jpeg;base64,{{$image->image_data}}"
                                             alt="{{$post->name}}" height="200px" width="100px">
                                    </div>
                                @endforeach
                            </div>

                            @if($post->postImages->count() > 1)
                                <a class="carousel-control-prev" href="#carouselExampleIndicators{{$key}}" role="button"
                                   data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators{{$key}}" role="button"
                                   data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            @endif

                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{$post->name}} <small>@ {{ $post->location}}</small></h4> <small>Rs.{{$post->rent}} per week</small>
                            <div>
                                <p class="elipsis card-text">{{$post->description}}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="nav-link" href="{{route('show', ['post' => $post])}}"><small>show more</small></a>
                        </div>
                    </div>
                </div>
            @empty
                <small class="ml-3">Nothing found</small>
            @endforelse
        </div>

        <ul class="pagination justify-content-center">
            {{$posts->links()}}
        </ul>

        <div class="row mt-5">
            <div class="col-md-8 mb-5">
                <h2>What We Do</h2>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi
                    soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam.
                    Repellat explicabo, maiores!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur
                    magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt
                    voluptate. Voluptatum.</p>
                {{--                <a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>--}}
            </div>
            <div class="col-md-4 mb-5">
                <h2>Contact Us</h2>
                <hr>
                <address>
                    <strong>Start Bootstrap</strong>
                    <br>3481 Melrose Place
                    <br>Beverly Hills, CA 90210
                    <br>
                </address>
                <address>
                    <abbr title="Phone">P:</abbr>
                    (123) 456-7890
                    <br>
                    <abbr title="Email">E:</abbr>
                    <a href="mailto:#">name@example.com</a>
                </address>
            </div>
        </div>


    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script src="{{asset('js/cookie.js')}}">
</script>
<script src="{{asset('js/form-validate.js')}}"></script>
</body>
</html>
