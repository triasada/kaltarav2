@extends('layouts.front')

@section('title')
{{ $title }}
@endsection

@push('css')
    <style>
        .registration-link{
            color: #000;
        }

        .registration-link:hover{
            text-decoration: none;
            color: #000;
        }
    </style>
@endpush

@section('content')
    <h4 class="font-weight-bold mt-3">{{ $title }}</h4>
    <div class="row">
        <div class="col-md-6">
            <h5 class="font-weight-bold mt-3">Pendaftaran Sertifikasi</h5>
            <hr>
            <ul>
            @foreach ($certifications as $certification)
                <li>
                    @if ($certification->isRegistrationOpen())
                        <a href="{{ route('certification.registration', [$certification->id]) }}" class="registration-link">{{ $certification->title }} (Menuju Link)</a>
                    @else
                        {{ $certification->title }} (Menuju Link)
                    @endif
                    <br>
                    <label style="color: red; font-weight: 700; font-size: 14px" class="m-0">Pendaftaran : {{ $certification->registration_start_date->format('d M Y') }} - {{ $certification->registration_end_date->format('d M Y') }}</label>
                    <label style="color: red; font-weight: 700; font-size: 14px" class="m-0">Pelaksanaan : {{ $certification->start_date->format('d M Y') }} - {{ $certification->end_date->format('d M Y') }}</label>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h5 class="font-weight-bold mt-3">Pendaftaran Pelatihan</h5>
            <hr>
            <ul>
                @foreach ($trainings as $training)
                    <li>
                        @if ($training->isRegistrationOpen())
                        <a href="{{ route('training.registration', [$training->id]) }}" class="registration-link">{{ $training->title }} (Menuju Link)</a>
                        @else
                            {{ $training->title }} (Menuju Link)
                        @endif
                        <br>
                        <label style="color: red; font-weight: 700; font-size: 14px" class="m-0">Pendaftaran : {{ $training->registration_start_date->format('d M Y') }} - {{ $training->registration_end_date->format('d M Y') }}</label>
                        <label style="color: red; font-weight: 700; font-size: 14px" class="m-0">Pelaksanaan : {{ $training->start_date->format('d M Y') }} - {{ $training->end_date->format('d M Y') }}</label>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@push('js')
@endpush