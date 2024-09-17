@extends('adminlte::page')

@section('plugins.DateTimePicker', true)

@section('title')
    {{ $title }}
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@push('css')
@endpush

@section('content')
<div class="row">
    @foreach ($webSettings as $setting)            
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('web-setting.update') }}" name="form{{ $setting->id }}" id="form{{ $setting->id }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="card-header">
                        <h4 class="card-title">{{ $setting->name }}</h4>
                    </div>
                    <div class="card-body">
                        <input type="text" name="value" class="form-control" value="{{ $setting->value }}" placeholder="Ex:">
                        <input type="hidden" name="id" value="{{ $setting->id }}">
        
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('js')
@endpush
