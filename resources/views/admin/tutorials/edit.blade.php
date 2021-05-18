@extends('admin.layouts.app')

@section('main')
<form action="{{route('admin.tutorials.update',[$topic->id,$tutorial->id])}}" method="POST">
    @csrf
    @method('put')

    <div class="form-group my-2">
        <label for='name'>Name</label>
        <input value="{{$tutorial->name??old('name')}}" name="name" type="text"
            class="form-control @error('name') is-invalid @enderror" required autocomplete="off">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message}}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group my-2">
        <label for="">Description</label>
        <textarea name="description" rows="20"
            class="form-control @error('description') is-invalid @enderror">{{$tutorial->description ?? old('description')}}</textarea>
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message}}</strong>
        </span>
        @enderror
    </div>

    <button class="btn btn-primary">Submit</button>
</form>
@endsection