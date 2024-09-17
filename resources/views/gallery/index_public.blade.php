@extends('layouts.front')

@section('title')
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
    <h4 class="font-weight-bold mt-3">{{ $title }}</h4>
    <div class="row mt-4">
        @foreach ($galleries as $content)
            <div class="col-md-4">
                <a href="{{ route('photo-gallery.show', [$content->gallery->id]) }}">
                    <img src="{{ asset($content->gallery->cover_path) }}" style="object-fit: cover; object-position: center; width: 100%; height: 150px;">
                </a>
                <div class="mt-2">
                    <a href="{{ route('photo-gallery.show', [$content->gallery->id]) }}" style="font-size: 22px; color: #000; line-height: 1.8rem; font-weight: 700">
                        {{ $content->gallery->title }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('js')
@endpush