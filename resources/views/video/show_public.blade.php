@extends('layouts.front')

@section('title')
    {{ $title }}
@endsection

@push('css')
    <style>
        .summary-article {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .title-article {
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

        @media(min-width: 992px) {
            .summary-article {
                -webkit-line-clamp: 3;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 announcement mt-3">
            <div>
                <iframe width="100%" height="500" src="{{ $video->youtube_embed_link }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            <div class="mt-2">
                <h4 class="font-weight-bold">{{ $video->title }}</h4>
                <span style="font-size: 13px;">{{ $video->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
