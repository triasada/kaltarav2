@extends('adminlte::page')

@section('title')
    {{ $title }}
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@endsection

@section('css')
@endsection

@section('plugins.Datatables', true)

@section('content')
    <div class="card">
        <div class="card-header text-right">
            @can('Create Role')
                <a href="{{ route('role.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Role</a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Role</th>
                            <th>Guard Name</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->guard_name }}</td>
                                <td>
                                    @can('Edit Role')
                                        <a href="{{ route('role.edit', [$role->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    @endcan
                                    @can('Delete Role')    
                                        <form action="{{ route('role.destroy', [$role->id]) }}" method="post" style="display: inline">
                                            <button  class="btn btn-sm btn-danger" type="submit" value="Delete">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                            @method('delete')
                                            @csrf
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
@endsection

@section('js')
    <script>
        $('.table').DataTable();
    </script>
@endsection