@extends('adminlte::page')

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
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <form action="{{ route('inventory-material.store.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <strong>{{ $title }}</strong>
                    </div>
                    <div class="card-body">
                        <div>
                            <a href="{{ asset('template/template_excel_inventory_material.xlsx') }}">Unduh template excel
                                disini</a>
                        </div>
                        <div class="mt-4">
                            <label>Choose File</label><br>
                            <input type="file" name="file_template" id="file">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fa fa-upload"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
