@extends('layouts.front')

@section('title')
{{ $title }}
@endsection

@push('css')
    <style>
        .img-article{
            object-fit: cover;
            object-position: center;
            height: 200px;
            width: 100%;
        }

        .other-article{
            border-bottom: solid 2px #081f4d;
        }

        .other-article a{
            color: #000;
            font-size: 16px;
            line-height: 1.5rem;
            font-weight: 700;
        }

        .other-article a:hover{
            text-decoration: none;
            color: #000;
        }

        .short-title{
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        @media(min-width: 992px){
            .img-article{
                height: 400px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row mt-4">
        <div class="col-md-8 offset-md-1">
            <h5 style="font-size: 14px; color: red; font-weight: 700" class="m-0">{{ $post->content->published_at->format('d M Y') }}</h5>
            <h2 style="font-weight: 700" class="mb-4">{{ $post->title }}</h2>
            <img src="{{ asset($post->thumbnail) }}" class="img-article mb-2">
            <div class="text-justify">
                {!! $post->body !!}
            </div>
        </div>
        <div class="col-md-3">
            <h4 class="m-0 text-center" style="font-weight: 700; color: #081f4d">Berita Lainnya</h4>
           <div class="mt-2">
                @foreach ($otherPost as $content)
                    <div class="d-flex py-2 other-article">
                        <a href="{{ route('post.read', [$content->post->id, $content->post->slug]) }}" class="my-auto short-title">{{ $content->post->title }}</a>
                    </div>
                @endforeach
           </div>
        </div>
    </div>
@endsection

@push('js')
@endpush