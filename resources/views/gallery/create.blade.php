@extends('adminlte::page')

@section('title')
    {{ $title }}
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@push('css')
    <style>
        .img-fit{
            height: 160px !important;
        }
    </style>
@endpush

@section('content')
<div class="card">
    <form action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
            </div>
            <div class="row">
                @for ($i = 1; $i <= 10; $i++)
                    <div class="col-6 col-md-4 col-lg-3 mt-2">
                        <div class="form-group border">
                            <div class="text-center photoButton" data-id="{{ $i }}">
                                <img class="img-fit" id="photoPreview{{ $i }}"
                                src="{{ asset('img/no_image_available.jpeg') }}">
                                <span class="btn btn-default btn-file mt-2">
                                    Choose Photo<input type="file" data-id="{{ $i }}" name="photo[]" accept="image/*">
                                </span>
                                {{-- <br>
                                <br>
                                <input type="radio" name="album_cover[]" id="album_cover{{ $i }}"> <label for="album_cover{{ $i }}">Album Cover</label> --}}
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
    <script>
        $('.photoButton').on('change', '.btn-file :file', function () {
            var id = $(this).data('id');
            readURL(this, 'photoPreview'+id);
        });
    </script>
@endpush