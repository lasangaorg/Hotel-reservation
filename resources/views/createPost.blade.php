@extends('layouts.app')

@section('content')
<div class="container">

    @if (count($errors) > 0)
    <div class="alert alert-danger mt-4">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('create')}}" method="POST" enctype="multipart/form-data" class=" mt-4 needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="propertyName">Property name</label>
            <input type="text" class="form-control" id="propertyName" name="name" placeholder="ex: Villa tempo" required>
            <div class="invalid-feedback">
                Please enter a name.
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="Address">Address</label>
                    <input type="text" class="form-control" id="Address" name="address" placeholder="ex: 111 street, colombo"
                           required>
                    <div class="invalid-feedback">
                        Please enter a address.
                    </div>
                </div>

            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="ex: Colombo" required>
                    <div class="invalid-feedback">
                        Please enter a location.
                    </div>
                </div>
            </div>

            <div class=" col-6 mb-3">
                <label for="rent">Weekly Rent</label>
                <input type="number" class="form-control" id="rent" name="rent" placeholder="ex: 5000" required>
                <div class="invalid-feedback">
                    Please enter a rental amount.
                </div>
            </div>

            <div class="col-6 mb-3">
                <label for="beds">Number of beds</label>
                <input type="number" class="form-control" id="beds" name="beds" placeholder="ex: 5" required>
                <div class="invalid-feedback">
                    Please enter the no.of beds available.
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="propertyType">Select property type</label>
            <select class="custom-select" name="type" required>
                @foreach($types as $type)
                <option value="{{$type}}">{{$type}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select a type</div>
        </div>

        <div class="mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description"
                      rows="5"
                      placeholder="ex: small villa with beautiful scenery" minlength="10" maxlength="255"
                      required></textarea>
            <div class="invalid-feedback">
                Please enter a description with more than 10 characters.
            </div>
        </div>

        <div class="custom-file">
            <input type="file" class="custom-file-input" name="image" id="validatedCustomFile">
            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
        </div>

        <input type="submit" class="mt-4 btn btn-block btn-primary" value="Post">
    </form>
</div>
@endsection
