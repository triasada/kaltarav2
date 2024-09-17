@extends('layouts.front')

@section('title')
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
    @if ($businessEntities->count())
        @foreach ($businessEntities as $businessEntity) 
            @if ($loop->iteration%2 == 0)
                <div class="row py-4" style="background-color: #f1f1f1">
                    <div class="col-md-8 d-flex">
                        <div class="my-auto mr-auto text-left">
                            <h2 class="m-0 font-weight-bold">{{ $businessEntity->name }} ({{ $businessEntity->businessType->name }})</h2>
                            <p style="font-size: 14px; line-height: 1.1rem" class="mt-2">
                                Alamat : {{ $businessEntity->address }}, {{ $businessEntity->district->name }} <br>
                                Email : {{ $businessEntity->email }} <br>
                                Telepon : {{ $businessEntity->phone_number }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="m-auto text-center border p-4 text-white" style="background-color: #081f4d;">
                            <h5 class="font-weight-bold" style="font-size: 38px">{{ $businessEntity->certified_workers_number }}</h5>
                            <h5 class="font-weight-bold">Pekerja Bersertifikat</h5>
                        </div>
                    </div>
                </div>
            @else
                <div class="row py-4">
                    <div class="col-md-8 d-flex">
                        <div class="my-auto">
                            <h2 class="m-0 font-weight-bold">{{ $businessEntity->name }} ({{ $businessEntity->businessType->name }})</h2>
                            <p style="font-size: 14px; line-height: 1.1rem" class="mt-2">
                                Alamat : {{ $businessEntity->address }}, {{ $businessEntity->district->name }} <br>
                                Email : {{ $businessEntity->email }} <br>
                                Telepon : {{ $businessEntity->phone_number }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="m-auto text-center border p-4 text-white" style="background-color: #081f4d;">
                            <h5 class="font-weight-bold" style="font-size: 38px">{{ $businessEntity->certified_workers_number }}</h5>
                            <h5 class="font-weight-bold">Pekerja Bersertifikat</h5>
                        </div>
                    </div>
                </div>
            @endif   
        @endforeach
        <div class="row mt-3">
            <div class="mx-auto">
                {{ $businessEntities->links() }}
            </div>
        </div>
    @else
        <h5 class="text-center">Data badan usaha belum tersedia</h5>
    @endif
@endsection

@push('js')
@endpush