@extends('layouts.front')

@section('title')
    {{ $title }}
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header">
                    <label class="font-weight-bold">Table Proyek Pekerjaan</label>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Paket</th>
                                    <th>Jenis Pekerjaan</th>
                                    <th>Instansi Pelaksana</th>
                                    <th>Bidang Yang Menangani</th>
                                    <th>Lokasi Pekerjaan</th>
                                    <th>Tahun Anggaran</th>
                                    <th>Jenis Kontrak</th>
                                    <th>Tanggal Kontrak</th>
                                    <th>Tanggal Selesai Kontrak</th>
                                    <th>Nilai Pekerjaan</th>
                                    <th>Sumber Dana</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projectJobs as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->projectJobType->name }}</td>
                                        <td>{{ $data->projectJobInstantion->name }}</td>
                                        <td>{{ $data->projectJobDesk->name }}</td>
                                        <td>{{ $data->district->name }}</td>
                                        <td>{{ $data->year }}</td>
                                        <td>{{ $data->projectJobContractType->name }}</td>
                                        <td>{{ $data->start_date->format('d-m-Y') }}</td>
                                        <td>{{ $data->end_date->format('d-m-Y') }}</td>
                                        <td>{{ $data->value }}</td>
                                        <td>{{ $data->projectJobSource->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $('.table').DataTable();
    </script>
@endpush
