@extends('layouts.admin')

@section('main')
<form action="{{route('admin.topics.update',$single->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="form-group my-2">
        <label for='name'>Name</label>
        <input value="{{$single->name ?? old('name')}}" name="name" type="text"
            class="form-control @error('name') is-invalid @enderror" required autocomplete="off">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message}}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group my-2">
        <label for='description'>Description</label>
        <input value="{{$single->description ?? old('description')}}" name="description" type="text"
            class="form-control @error('description') is-invalid @enderror" autocomplete="off">
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message}}</strong>
        </span>
        @enderror
    </div>

    <img src="{{asset($single->image_url)}}" style="height:100px" class="my-2">

    <div class="form-group my-2">
        <label for="image">Image</label>
        <input name="image" type="file" class="form-control-file @error('image') is-invalid @enderror" id="image">
        @error('image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message}}</strong>
        </span>
        @enderror
    </div>

    <button class="btn btn-primary">Submit</button>
</form>
@endsection