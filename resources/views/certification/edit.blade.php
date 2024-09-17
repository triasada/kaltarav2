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
<div class="card">
    <div class="card-body">
        <form action="{{ route('certification.update', [$certification->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Title</label>
                    <input type="text" name="title" id="name" class="form-control" placeholder="Title" required value="{{ $certification->title }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Description">{{ $certification->description }}</textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label>Registration Start Date</label>
                    <div class="input-group date" id="registration_start_date" data-target-input="nearest">
                        <input type="text" name="registration_start_date" class="form-control datetimepicker-input" data-target="#registration_start_date"  placeholder="Registration Start Date" required value="{{ $certification->registration_start_date->format('d-m-Y') }}"/>
                        <div class="input-group-append" data-target="#registration_start_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>Registration End Date</label>
                    <div class="input-group date" id="registration_end_date" data-target-input="nearest">
                        <input type="text" name="registration_end_date" class="form-control datetimepicker-input" data-target="#registration_end_date"  placeholder="Registration End Date" required value="{{ $certification->registration_end_date->format('d-m-Y') }}"/>
                        <div class="input-group-append" data-target="#registration_end_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>Start Date</label>
                    <div class="input-group date" id="start_date" data-target-input="nearest">
                        <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#start_date"  placeholder="Registration Start Date" required value="{{ $certification->start_date->format('d-m-Y') }}"/>
                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>End Date</label>
                    <div class="input-group date" id="end_date" data-target-input="nearest">
                        <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#end_date"  placeholder="End Date" required value="{{ $certification->end_date->format('d-m-Y') }}"/>
                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script>
        $('#registration_start_date').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#registration_end_date').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#start_date').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#end_date').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    </script>
@endpush