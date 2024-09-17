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
    @if ($contentPosts->count())
        <div class="row">
            @foreach ($contentPosts as $content)
                <div class="col-md-6 col-lg-4 announcement mt-2">
                    <div>
                        <a href="{{ route('post.read', [$content->post->id, $content->post->slug]) }}">
                            <img src="{{ asset($content->post->thumbnail) }}" style="object-fit: cover; object-position: center; height: 200px; width: 100%">
                        </a>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('post.read', [$content->post->id, $content->post->slug]) }}" class="title-article">
                            {{ $content->post->title }}
                        </a>
                        <span style="font-size: 13px;">{{ $content->published_at->format('d M Y') }}</span>
                        <p class="mt-2 summary-article">
                            {{ $content->post->summary }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h5 class="text-center font-weight bold">
            There is no posts now
        </h5>
    @endif
@endsection

@push('js')
@endpush