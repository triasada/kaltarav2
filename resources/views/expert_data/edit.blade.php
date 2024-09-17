@extends('adminlte::page')

@section('title')
    {{ $title }}
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@push('css')
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('expert-data.update', [$expertData->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" placeholder="Nama" class="form-control" required value="{{ $expertData->name }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" placeholder="NIK" class="form-control" required value="{{ $expertData->id_number }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="birth_date">Tanggal Lahir</label>
                        <input type="text" name="birth_date" id="birth_date" placeholder="Tanggal Lahir" class="form-control" required value="{{ $expertData->birth_date->format('m/d/Y') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="gender">Jenis Kelamin</label>
                        {!! Form::select('gender', GENDER_ARRAY_INDONESIAN, $expertData->gender, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="job">Pekerjaan</label>
                        {!! Form::select('jobs_id', $jobs, $expertData->jobs_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="address">Alamat</label>
                        <input type="text" name="address" id="address" placeholder="Alamat" class="form-control" required value="{{ $expertData->address }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="district">Kabupaten/Kota</label>
                        {!! Form::select('district_id', $districts, $expertData->district_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="phone_number">Nomor HP (WA)</label>
                        <input type="text" name="phone_number" id="phone_number" placeholder="Nomor HP (WA)" class="form-control" required value="{{ $expertData->phone_number }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" required value="{{ $expertData->email }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="education_level">Pendidikan</label>
                        {!! Form::select('education_level_id', $educationLevels, $expertData->education_level_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="ska_classification">Klasifikasi SKA</label>
                        {!! Form::select('ska_classification_id', $skaClassifications, $expertData->ska_classification_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="sub_classification_code">Kode Sub. Klasifikasi</label>
                        <input type="text" name="sub_classification_code" id="sub_classification_code" placeholder="Kode Sub. Klasifikasi" class="form-control" required value="{{ $expertData->sub_classification_code }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="sub_classification_name">Nama Sub. Klasifikasi</label>
                        <input type="text" name="sub_classification_name" id="sub_classification_name" placeholder="Nama Sub. Klasifikasi" class="form-control" required value="{{ $expertData->sub_classification_name }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="qualification">Kualifikasi</label>
                        {!! Form::select('qualification_id', $qualifications, $expertData->qualification_id, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="epireDate">Tanggal Expire</label>
                        <input type="text" name="expire_date" id="expireDate" placeholder="Tanggal Expire" class="form-control" value="{{ ($expertData->expire_date)?$expertData->expire_date->format('d M Y'):'' }}" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-md btn-success"><i class="fa fa-paper-plane"></i> Send</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $('#nik').inputFilter(function(value) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
        });
        $('#phone_number').inputFilter(function(value) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
        });
        $('#birth_date').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#expireDate').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@endpush