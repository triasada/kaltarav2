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
                    @can('Create School')
                        <a href="{{ route('school.import') }}" class="btn btn-xs btn-info">
                            <i class="fa fa-upload"></i> Import Data
                        </a>
                        <a href="{{ route('school.create') }}" class="btn btn-xs btn-success">
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
                                    <th>Kota</th>
                                    <th>Alamat</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schools as $school)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $school->name }}</td>
                                        <td>{{ $school->city }}</td>
                                        <td>{{ $school->address }}</td>
                                        <td>
                                            @can('Edit School')
                                                <a href="{{ route('school.edit', [$school->id]) }}"
                                                    class="btn btn-xs btn-warning mr-1">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            @endcan
                                            @can('Delete School')
                                                <form action="{{ route('school.destroy', [$school->id]) }}" method="post">
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
