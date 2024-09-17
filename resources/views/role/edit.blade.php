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
        <div class="card-body">
            <form action="{{ route('role.update', [$role->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Role Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $role->name }}" placeholder="Role Name" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="permission" class="m-0">Permission</label>
                            <div class="row">
                                @foreach ($permissionGroups as $permissionGroup)
                                    <div class="col-md-3 mt-2">
                                        <div class="border p-2 h-100 mt-2">
                                            <div class="font-weight-bold">{{ $permissionGroup->name }}</div>
                                            <hr class="my-1">
                                            @foreach ($permissionGroup->permissions->where('is_user_permission',0)->sortBy('sequence')->values() as $permission)
                                                <div>
                                                    @php
                                                        $isChecked = false;
                                                        if ($role->permissions->where('id', $permission->id)->first())
                                                        {
                                                            $isChecked = true;
                                                        }
                                                    @endphp
                                                    <input style="cursor: pointer" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->id }}" {{ ($isChecked)? 'checked':'' }}> <label for="{{ $permission->id }}" class="font-weight-normal" style="cursor: pointer">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 offset-md-4 text-center">
                        <button type="submit" class="btn btn-success btn-sm form-control"><i class="fa fa-save"></i> Update Role</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection