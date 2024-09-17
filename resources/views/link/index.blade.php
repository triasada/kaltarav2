@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title')
    {{ $title }}
@stop

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@section('content')
    <div class="card">
        @can('Create Link Url')
            <div class="card-header text-right">
                <a href="{{ route('link-url.create') }}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> Add Link Url
                </a>
            </div>
        @endcan
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Url</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($links as $link)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $link->name }}</td>
                                <td>{{ $link->url }}</td>
                                <td class="d-flex">
                                    @can('Edit Link Url')
                                        <a href="{{ route('link-url.edit', [$link->id]) }}" class="btn btn-xs btn-warning">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    @endcan
                                    @can('Delete Link Url')
                                        <form action="{{ route('link-url.destroy', [$link->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger ml-1">
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
@stop

@push('js')
    <script>
        $('.table').DataTable();
    </script>
@endpush
