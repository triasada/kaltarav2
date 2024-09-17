@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title')
    {{ $title }}
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@push('css')
@endpush

@section('content')
<div class="card">
    <div class="card-header text-right">
        <a href="{{ route('user.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add User</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th style="width: 15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </td>
                            <td>{{ $user->is_approved? 'Approved':'Pending' }}</td>
                            <td>
                                @can('Edit User')
                                    <a href="{{ route('user.edit', [$user->id]) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    @if (!$user->isApproved())
                                        {{-- <a href="{{ route('user.cancel.approve', [$user->id]) }}" class="btn btn-xs btn-danger mt-1"><i class="fa fa-times"></i> Cancel Approve</a> --}}
                                    {{-- @else --}}
                                        <a href="{{ route('user.approve', [$user->id]) }}" class="btn btn-xs btn-success mt-1"><i class="fa fa-check"></i> Approve</a>
                                    @endif
                                    <a href="{{ route('user.edit-password', [$user->id]) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit Password</a>
                                @endcan
                                @can('Delete User')
                                    @if ($user->id != Auth::user()->id)
                                        <form action="{{ route('user.destroy', [$user->id]) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-xs btn-danger mt-1"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    @endif
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

@push('js')
    <script>
        $('.table').DataTable();
    </script>
@endpush