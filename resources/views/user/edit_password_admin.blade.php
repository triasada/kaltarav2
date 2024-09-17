@extends('adminlte::page')

@section('title')
    {{ $title }}
@endsection

@push('css')
@endpush

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body" style="font-size: 14px">
                    <form action="{{ route('user.update-password', [$user->id]) }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Confirm New Password</label>
                            <div class="col-sm-8">
                                <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm New Password" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush