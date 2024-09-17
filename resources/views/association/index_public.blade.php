@extends('layouts.front')

@section('title')
    {{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="card mt-2 mt-md-4">
        <div class="card-header">
            <label class="font-weight-bold">Tabel Asosiasi Jasa Konstruksi</label>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Asosiasi</th>
                            <th>Alamat</th>
                            <th>Kabupaten/Kota</th>
                            <th>Nomor Telepon</th>
                            <th>Email</th>
                            <th>Struktur Akreditasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($associations as $association)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $association->associationType->name ?? '-' }}</td>
                                <td>{{ $association->address ?? '-' }}</td>
                                <td>{{ $association->district->name ?? '-' }}</td>
                                <td>{{ $association->phone_number ?? '-' }}</td>
                                <td>{{ $association->email ?? '-' }}</td>
                                <td>{{ $association->accreditationStructure->name ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if (0)
        @if (isset($associations) && $associations->count())
            @foreach ($associations as $association)
                @if ($loop->iteration % 2 == 0)
                    <div class="row py-4" style="background-color: #f1f1f1">
                        <div class="col-md-12 d-flex">
                            <div class="my-auto ml-auto text-right">
                                <h2 class="m-0 font-weight-bold">{{ $association->name }}
                                    ({{ $association->associationType->name }})
                                </h2>
                                <p style="font-size: 14px; line-height: 1.1rem" class="mt-2">
                                    Alamat : {{ $association->address }}, {{ $association->associationType->name }} <br>
                                    Email : {{ $association->email }} <br>
                                    Telepon : {{ $association->phone_number }}
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row py-4" style="background-color: #f1f1f1">
                        <div class="col-md-12 d-flex">
                            <div class="my-auto text-right">
                                <h2 class="m-0 font-weight-bold">{{ $association->name }}
                                    ({{ $association->associationType->name }})</h2>
                                <p style="font-size: 14px; line-height: 1.1rem" class="mt-2">
                                    Alamat : {{ $association->address }}, {{ $association->associationType->name }} <br>
                                    Email : {{ $association->email }} <br>
                                    Telepon : {{ $association->phone_number }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <h5 class="text-center">Data asosiasi tidak tersedia</h5>
        @endif
    @endif
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $('.table').DataTable();
    </script>
@endpush
