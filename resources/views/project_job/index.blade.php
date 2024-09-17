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
                    @can('Create Project Job')
                        <a href="{{ route('project.import') }}" class="btn btn-xs btn-info"><i class="fa fa-upload"></i> Import
                            Data</a>
                    @endcan
                    @can('Create Project Job')
                        <a href="{{ route('project.create') }}" class="btn btn-xs btn-success">
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
                                    <th>Tahun</th>
                                    <th>Jenis Pekerjaan</th>
                                    <th>Sumber Dana</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projectJobs as $project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->year }}</td>
                                        <td>{{ $project->projectJobType->name ?? '-' }}</td>
                                        <td>{{ $project->projectJobSource->name ?? '-' }}</td>
                                        <td class="d-flex">
                                            @can('Edit Project Job')
                                                <a href="{{ route('project.edit', [$project->id]) }}"
                                                    class="btn btn-xs btn-warning mr-1">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            @endcan
                                            @can('Delete Project Job')
                                                <form action="{{ route('project.destroy', [$project->id]) }}" method="post">
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
