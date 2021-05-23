@extends('layouts.admin')

@section('main')
<x-alert-messages />
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

<script>
    // Alternative to load event
    document.onreadystatechange = function () {
        if (document.readyState === 'complete') {
            $('textarea').summernote({
                fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24'],
                toolbar:[
                    ['pagebreak',['pagebreak']], // The Button
                    ['style',['style']],
                    ['font',['bold','italic','underline','clear']],
                    ['fontsize', ['fontsize']],
                    ['color',['color']],
                    ['para',['ul','ol','paragraph']],
                    ['height',['height']],
                    ['table',['table']],
                    ['insert',['media','link','hr']],
                    ['view',['fullscreen','codeview']],
                    ['help',['help']]
                ],
            });
        }
    }
    
</script>
@endsection