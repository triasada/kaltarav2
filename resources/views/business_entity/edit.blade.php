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
        <form action="{{ route('business-entity.update', [$businessEntity->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Nama</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama" required value="{{ $businessEntity->name }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>Alamat</label>
                    <textarea name="address" id="address" class="form-control" placeholder="Alamat" required>{{ $businessEntity->address }}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label>Kabupaten / Kota</label>
                    {!! Form::select('district_id', $districts, $businessEntity->district_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                </div>
                <div class="col-md-12 form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="phone_number" id="phoneNumber" class="form-control" placeholder="Nomor Telepon" autocomplete="off" required value="{{ $businessEntity->phone_number }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" autocomplete="off" required value="{{ $businessEntity->email }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>Jenis Usaha</label>
                    {!! Form::select('business_type_id', $businessTypes, $businessEntity->business_type_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                </div>
                <div class="col-12 form-group">
                    <label>Asosiasi</label>
                    {!! Form::select('association_id', $associations, $businessEntity->association_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                </div>
                <div class="col-md-12 form-group">
                    <label>Jumlah Pekerja Bersertifikat</label>
                    <input type="text" name="certified_workers_number" id="certified_workers_number" class="form-control" placeholder="Jumlah Pekerja Bersertifikat" autocomplete="off" required value="{{ $businessEntity->certified_workers_number }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>SKA</label>
                    <input type="text" name="SKA" id="SKA" class="form-control" placeholder="SKA" required value="{{ $businessEntity->SKA }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>SKT</label>
                    <input type="text" name="SKT" id="SKT" class="form-control" placeholder="SKT" required value="{{ $businessEntity->SKT }}">
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
        // phone number
        $("#phoneNumber").inputFilter(function(value) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
        });
        $("#certified_workers_number").inputFilter(function(value) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
        });
    </script>
@endpush