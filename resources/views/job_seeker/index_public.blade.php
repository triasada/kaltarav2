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
                    <label class="font-weight-bold">Table {{ $title }}</label>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Pendidikan</th>
                                    <th>Sertifikasi yang dimiliki</th>
                                    <th>Klasifikasi Sertifikasi</th>
                                    <th>Kualifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobSeekers as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->address }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->schoolLevel->name ?? '-' }}</td>
                                        <td>{{ $data->certificationType->name ?? '-' }}</td>
                                        <td>{{ $data->certification_name ?? '-' }}</td>
                                        <td>{{ $data->qualification->name }}</td>
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