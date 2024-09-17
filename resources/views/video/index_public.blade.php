@extends('layouts.front')

@section('title')
{{ $title }}
@endsection

@push('css')
    <style>
        .summary-article{
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .title-article{
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            font-weight: 700;
            font-size: 24px;
            line-height: 1.8rem;
            color: #000
        }
        @media(min-width: 992px){
            .summary-article{
                -webkit-line-clamp: 3;
            }
        }
    </style>
@endpush

@section('content')
    <h4 class="font-weight-bold mt-3">{{ $title }}</h4>
    @if ($videos->count())
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-md-6 col-lg-4 announcement mt-3">
                    <div>
                        <a href="{{ route('gallery-video-show', [$video->id]) }}">
                            <img src="{{ $video->youtubeThumbMq }}" style="object-fit: cover; object-position: center; height: 200px; width: 100%">
                        </a>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('gallery-video-show', [$video->id]) }}" class="title-article">
                            {{ $video->title }}
                        </a>
                        <span style="font-size: 13px;">{{ $video->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 text-center mt-4">
                {!! $videos->links('vendor.pagination.bootstrap-4') !!}
            </div>
        </div>
    @else
        <h5 class="text-center font-weight bold">
            There is no video now
        </h5>
    @endif
@endsection

@push('js')
@endpush
