@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{$post->name}}
            <small>({{$post->type}})</small>
        </h1>

        <!-- Portfolio Item Row -->
        <div class="row">
            <div id="carouselExampleIndicators" class=" col-md-8 carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @if($post->postImages->count() <= 0)
                        <div class="carousel-item active">
                            <img class="d-block w-100"
                                 src="http://placehold.it/700x400?auto=yes&bg=777&fg=555&text=No images to display"
                                 alt="First slide" height="250px" width="100px">
                        </div>
                    @endif
                    @foreach($post->postImages as $image)
                        <div
                            class="carousel-item {{$image->id == $post->postImages[0]->id ? 'active': ''}}">
                            <img class="img-fluid d-block w-100"
                                 src="data:image/jpeg;base64,{{$image->image_data}}"
                                 alt="First slide">
                        </div>
                    @endforeach
                </div>
                @if($post->postImages->count() > 1)
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                       data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                       data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                @endif
            </div>

            <div class="col-md-4">
                <h3 class="my-3">About {{$post->name}}</h3>
                <p>{{$post->description}}</p>
                <h3 class="my-3">Details</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Rs.{{$post->rent}} per week</li>
                    <li class="list-group-item">{{$post->beds}} bedrooms available</li>
                    <li class="list-group-item">@ {{$post->location}}</li>
                    <li class="list-group-item">{{$post->address}}</li>
                    <li class="list-group-item">#{{$post->type}}</li>
                </ul>
            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <h3 class="my-4">More destinations</h3>

        <div class="row">

            @foreach($otherPosts as $otherPost)
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="#">
                        @if($otherPost->postImages->count() <= 0)
                            <img class="img-fluid" src="http://placehold.it/500x300" alt="{{$otherPost->name}}">
                            @else
                            <img src="data:image/jpeg;base64,{{$otherPost->postImages[0]->image_data}}" height="200px"
                                 width="200px" alt="{{$otherPost->name}}">
                        @endif

                    </a>
                    <a class="nav-link" href="{{route('show', ['post' => $otherPost])}}"><small>show more</small></a>
                </div>
            @endforeach
        </div>
        <ul class="pagination justify-content-center">
            {{$otherPosts->links()}}
        </ul>
    </div>
@endsection
