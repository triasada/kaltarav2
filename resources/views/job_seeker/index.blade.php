@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title')
    {{ $title }}
@stop

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-right">
                    @can('Create Job Seeker')
                        <a href="{{ route('job-seeker.create') }}" class="btn btn-xs btn-success">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tableProject">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Pekerjaan</th>
                                    <th>Kota</th>
                                    <th>Alamat</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobSeekers as $jobSeeker)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jobSeeker->name }}</td>
                                        <td>{{ $jobSeeker->jobType->name ?? '-' }}</td>
                                        <td>{{ $jobSeeker->district->name ?? '-' }}</td>
                                        <td>{{ $jobSeeker->address }}</td>
                                        <td>
                                            @can('Edit Job Seeker')
                                                <a href="{{ route('job-seeker.edit', [$jobSeeker->id]) }}"
                                                    class="btn btn-xs btn-warning mr-1">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            @endcan
                                            @can('Delete Job Seeker')
                                                <form action="{{ route('job-seeker.destroy', [$jobSeeker->id]) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $('#tableProject').DataTable();
    </script>
@endpush
