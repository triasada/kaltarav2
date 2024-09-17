@extends('adminlte::page')

@section('title')
    {{ $title }}
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@push('css')
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Post Category</label>
                {!! Form::select('post_category_id', $postCategories, null, ['class' => 'form-control', 'placeholder' => 'Choose One', 'required']) !!}
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name='body' id="createArticle" class="form-control body">{{ old('body') }}</textarea>
            </div>
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="text" name="thumbnail" id="thumbnail" class="form-control" placeholder="Thumbnail">
            </div>
    
            <div class="form-group">
                <label for="excerpt">Summary</label>
                <textarea name="excerpt" id="excerpt" class="form-control" placeholder="Summary"></textarea>
            </div>
    
            <div class="text-center">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Publish</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
       initiateTinyMCE('textarea.body', 'createArticle', '{{ route('image.upload') }}');
    </script>
@endpush