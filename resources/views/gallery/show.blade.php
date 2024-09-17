@extends('layouts.front')

@section('title')
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">

<style>
    .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span{
        background-color: #081f4d
    }
</style>
@endpush

@section('content')
    <h4 class="font-weight-bold mt-3">{{ $title }}</h4>
    <div class="row mt-md-5 mt-2">
        <div class="col-md-5 offset-md-2">
            <div class="owl-carousel owl-theme">
                @foreach ($gallery->photos as $photo)
                    <div class="item">
                        <img src="{{ asset($photo->image_path) }}" class="img-fluid" style="max-height: 500px">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-2">
            <h5><strong>{{ $gallery->title }}</strong></h5>
            <p class="mt-4">
                {{ $gallery->description }}
            </p>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $('.owl-carousel').owlCarousel({
        loop:false,
        nav:false,
        items:1
    })
</script>
@endpush