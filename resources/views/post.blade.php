@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('create')}}" class="mt-5 mb-3 btn btn-success">Add new post</a>

        <div id="sectionNews" class="row">
            @forelse($posts as $key => $post)
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div id="carouselExampleIndicators{{$key}}" class="carousel slide" data-ride="carousel">
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
                                        <img class="d-block w-100"
                                             src="data:image/jpeg;base64,{{$image->image_data}}"
                                             alt="First slide" height="250px" width="100px">
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
                            <div class="btn-group-sm mb-3" role="group" aria-label="Basic example">
                                <a href="{{route('showAddImage', ['post' => $post])}}" class="btn btn-success">Add more images</a>
                                <a href="{{route('showEdit', ['post' => $post])}}" class="btn btn-warning">Edit</a>
                                <form style="display: inline" action="{{route('delete', ['post' => $post])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                </form>
                            </div>
                            <h4 class="card-title">
                                <a href="#">{{$post->name}} <small>({{$post->type}})</small></a>
                            </h4>
                            <div>
                                <p class="card-text">{{$post->description}}</p>
                            </div>
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
    </div>
@endsection
