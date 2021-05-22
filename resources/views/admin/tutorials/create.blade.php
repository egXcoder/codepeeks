@extends('layouts.admin')

@section('main')
<form action="{{route('admin.tutorials.store',$topic->id)}}" method="POST">
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
        <label for="">Description</label>
        <textarea name="description" rows="20" class="form-control @error('description') is-invalid @enderror">
         {!!old('description')!!}
        </textarea>
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message}}</strong>
        </span>
        @enderror
    </div>

    <button class="btn btn-primary">Submit</button>
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
                ['fontname',['fontname']],
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