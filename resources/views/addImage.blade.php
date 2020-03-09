@extends('layouts.app')

@section('content')
    <div class="container">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('addImage', ['post' => $post])}}" method="post" enctype="multipart/form-data"
              class=" mt-4 needs-validation" novalidate>
            @csrf

            <div class="row">
                <div class="col-6">
                    <div class="custom-file mb-4">
                        <input type="file" class="custom-file-input" name="image" id="validatedCustomFile" required>
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    </div>
                </div>
                <div class="col-6">
                    <input type="submit" class=" btn btn-block btn-success" value="Add Image">
                </div>
            </div>
        </form>
        <div class="row text-center text-lg-left">

            @foreach($postImages as $image)
                <div class="col-lg-3 col-md-4 col-6">
                    <form style="display: inline" action="{{route('deleteImage', ['postImage' => $image])}}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <input style="position: absolute" type="submit" class="btn btn-sm btn-danger" value="x">
                    </form>
                    <img class="img-fluid img-thumbnail" src="data:image/jpeg;base64,{{$image->image_data}}"
                         height="250px" width="200px !important" alt="">
                </div>
            @endforeach
        </div>
    </div>
@endsection
