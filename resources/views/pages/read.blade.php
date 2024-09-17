@extends('layouts.front')

@section('title')
    {{ $title }}
@endsection

@push('css')
    <style>
        #pageBody img{
            max-width: 100% !important;
            height: auto !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 my-3" id="pageBody">
            <h2 style="font-weight: 700" class="mb-4">{{ $page->title }}</h2>

            {!! $page->body !!}
        </div>
    </div>
@endsection

@push('js')
@endpush