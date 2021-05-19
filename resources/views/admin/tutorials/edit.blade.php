@extends('admin.layouts.app')

@section('main')
<div class="container-fluid">
    <form action="{{route('admin.tutorials.update',[$topic->id,$tutorial->id])}}" method="POST">
        @csrf
        @method('put')

        <div class="form-group m-2">
            <label for='name'>Name</label>
            <input value="{{$tutorial->name??old('name')}}" name="name" type="text"
                class="form-control @error('name') is-invalid @enderror" required autocomplete="off">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>

        <div id="toolbar-container"></div>
        <!-- This container will become the editable. -->
        <div id="editor"></div>

        <div class="form-group mx-2">
            <label for="description">Description</label>
            <textarea name="description"
                class="form-control @error('description') is-invalid @enderror">{!!$tutorial->description ?? old('description')!!}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message}}</strong>
            </span>
            @enderror
        </div>

        <button class="btn btn-primary m-2">Submit</button>
    </form>
</div>

<script>
    // Alternative to load event
    document.onreadystatechange = function () {
        if (document.readyState === 'complete') {
            $('textarea').summernote();
        }
    }
    
</script>
@endsection