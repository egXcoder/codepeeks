@extends('admin.layouts.app')

@section('main')
<form action="{{route('admin.topics.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group my-2">
        <label for='name'>Name</label>
        <input value="{{old('name')}}" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
            required autocomplete="off">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message}}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group my-2">
        <label for='description'>Description</label>
        <input value="{{old('description')}}" name="description" type="text"
            class="form-control @error('description') is-invalid @enderror" autocomplete="off">
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message}}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group my-2">
        <label for="image">Image</label>
        <input name="image" type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
            required>
        @error('image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message}}</strong>
        </span>
        @enderror
    </div>

    <button class="btn btn-primary">Submit</button>
</form>
@endsection