@extends('adminlte::page')

@section('plugins.DateTimePicker', true)

@section('title')
    {{ $title }}
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@push('css')
    <style>
        .custom-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('association.update', [$association->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Nama</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama" required value="{{ $association->name }}">
                </div>
                <div class="col-md-6 form-group">
                    <label>Tanggal Terbentuk</label>
                    <div class="input-group date" id="formed_date" data-target-input="nearest">
                        <input type="text" name="formed_date" class="form-control datetimepicker-input" data-target="#formed_date" placeholder="Tanggal Terbentuk" required value="{{ $association->formed_date->format('d-m-Y') }}">
                        <div class="input-group-append" data-target="#formed_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>Jenis Asosiasi</label>
                    {!! Form::select('association_type_id', $associationTypes, $association->association_type_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                </div>
                <div class="col-md-6 form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" autocomplete="off" required value="{{ $association->email }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>Alamat</label>
                    <textarea name="address" id="address" class="form-control" placeholder="Alamat" required>{{ $association->address }}</textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label>Kabupaten / Kota</label>
                    {!! Form::select('district_id', $districts, $association->district_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                </div>
                <div class="col-md-6 form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="phone_number" id="phoneNumber" class="form-control" placeholder="Nomor Telepon" autocomplete="off" required value="{{ $association->phone_number }}">
                </div>
                <div class="col-md-12 form-group">
                    <label>Contact Person</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="contact_person_name" id="contact_person_name" class="form-control" placeholder="Nama" autocomplete="off" value="{{ $association->contact_person_name ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="contact_person_number" id="contact_person_number" class="form-control" placeholder="Nomor Telepon" autocomplete="off" value="{{ $association->contact_person_number ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>Jumlah Anggota</label>
                    <input type="text" name="member_number" id="member_number" class="form-control" placeholder="Jumlah Pekerja Bersertifikat" autocomplete="off" required value="{{ $association->member_number }}">
                </div>
                <div class="col-md-6 form-group">
                    <label>Sruktur Akreditasi</label>
                    {!! Form::select('accreditation_structure_id', $accreditationStructures, $association->accreditation_structure_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                </div>
                <div class="col-md-12">
                    <Label>Scan Struktur Organisasi</Label>
                    <br>
                    <label for="orgatization_structure_path" class="custom-upload">
                        <i class="fa fa-cloud-upload"></i> Upload
                    </label>
                    <span id="orgatization_structure_path_label"class="file-label">{{ $association->scan_file_name }}</span>
                    <input type="file" name="orgatization_structure_path" id="orgatization_structure_path" class="d-none file-button">
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
        $("#contact_person_number").inputFilter(function(value) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
        });
        $("#member_number").inputFilter(function(value) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
        });

        // birthdate 
        $('#formed_date').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('.file-button').change(function() {
            var file = $(this)[0].files[0].name;
            var parent = $(this).parent();
            parent.find('.file-label').text(file);
        });
    </script>
@endpush