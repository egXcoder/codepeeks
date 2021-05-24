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
       <label for='short_description'>Short Description</label>
       <input value="{{old('short_description')}}" name="short_description" type="text" class="form-control @error('short_description') is-invalid @enderror" required autocomplete="off">
       @error('short_description')
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
<style>
    textarea,
    .note-editable {
        font-family: 'Segoe UI', sans-serif;
        font-size: 16px;
        line-height: 1.5;
    }
</style>
<script>
    // Alternative to load event
    document.onreadystatechange = function () {
        if (document.readyState === 'complete') {
            $('textarea').summernote({
                styleTags: [
                    'p',
                    { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
                    { title: 'Notice', tag: 'div', className: 'notice' , value:'div' },
                    { title: 'Tip', tag: 'div', className: 'tip' , value:'div' },
                    'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
                ],
                fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24'],
                fontSizeUnits: ['px'],
                toolbar:[
                    ['pagebreak',['pagebreak']], // The Button
                    ['style',['style']],
                    ['font',['bold','italic','underline','clear','fontname', 'fontsize', 'fontsizeunit']],
                    ['color',['color']],
                    ['para',['ul','ol','paragraph']],
                    // ['height',['height']],
                    ['table',['table']],
                    ['insert',['media','link','hr']],
                    ['view',['fullscreen','codeview']],
                    ['help',['help']]
                ],
                popover: {
                image: [
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']],
                    ['custom', ['imageAttributes']],
                    ],
                },
                height:400,
            });
        }
    }
    
</script>
@endsection