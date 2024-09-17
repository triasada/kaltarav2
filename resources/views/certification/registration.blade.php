@extends('layouts.front')

@section('title')
{{ $title }}
@endsection

@push('css')
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card my-3" style="border-radius: 10px">
                <form action="{{ route('certification.registration.store', [$certification->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4 class="font-weight-bold mt-3">{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" placeholder="Nama" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" placeholder="NIK" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="birth_date">Tanggal Lahir</label>
                                <input type="text" name="birth_date" id="birth_date" placeholder="Tanggal Lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="gender">Jenis Kelamin</label>
                                {!! Form::select('gender', GENDER_ARRAY_INDONESIAN, null, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="job">Pekerjaan</label>
                                {!! Form::select('jobs_id', $jobs, null, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Alamat</label>
                                <input type="text" name="address" id="address" placeholder="Alamat" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="district">Kabupaten/Kota</label>
                                {!! Form::select('district_id', $districts, null, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone_number">Nomor HP (WA)</label>
                                <input type="text" name="phone_number" id="phone_number" placeholder="Nomor HP (WA)" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="education_level">Pendidikan</label>
                                {!! Form::select('education_level_id', $educationLevels, null, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="ska_classification">Klasifikasi SKA</label>
                                {!! Form::select('ska_classification_id', $skaClassifications, null, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="sub_classification_code">Kode Sub. Klasifikasi</label>
                                <input type="text" name="sub_classification_code" id="sub_classification_code" placeholder="Kode Sub. Klasifikasi" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="sub_classification_name">Nama Sub. Klasifikasi</label>
                                <input type="text" name="sub_classification_name" id="sub_classification_name" placeholder="Nama Sub. Klasifikasi" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="qualification">Kualifikasi</label>
                                {!! Form::select('qualification_id', $qualifications, null, ['class' => 'form-control', 'placeholder' => 'Pilih Satu', 'required']) !!}
                            </div>
                            <div class="col-md-6 mt-2">
                                <Label>Scan Ijazah Legalisir</Label>
                                <br>
                                <label for="school_diploma_path" class="custom-upload">
                                    <i class="fa fa-cloud-upload"></i> Upload
                                </label>
                                <label id="school_diploma_path_label"class="file-label">No File</label>
                                <input type="file" name="school_diploma_path" id="school_diploma_path" class="d-none file-button" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <Label>Form Daftar Pengalaman Kerja</Label>
                                <br>
                                <label for="work_experience_path" class="custom-upload">
                                    <i class="fa fa-cloud-upload"></i> Upload
                                </label>
                                <label id="work_experience_path_label"class="file-label">No File</label>
                                <input type="file" name="work_experience_path" id="work_experience_path" class="d-none file-button" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <Label>Scan KTP</Label>
                                <br>
                                <label for="id_card_path" class="custom-upload">
                                    <i class="fa fa-cloud-upload"></i> Upload
                                </label>
                                <label id="id_card_path_label"class="file-label">No File</label>
                                <input type="file" name="id_card_path" id="id_card_path" class="d-none file-button" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <Label>Scan NPWP</Label>
                                <br>
                                <label for="npwp_path" class="custom-upload">
                                    <i class="fa fa-cloud-upload"></i> Upload
                                </label>
                                <label id="npwp_path_label"class="file-label">No File</label>
                                <input type="file" name="npwp_path" id="npwp_path" class="d-none file-button" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <Label>Scan Surat Pernyataan Kebenaran Data Dokumen (bermaterai)</Label>
                                <br>
                                <label for="statement_letter_path" class="custom-upload">
                                    <i class="fa fa-cloud-upload"></i> Upload
                                </label>
                                <label id="statement_letter_path_label"class="file-label">No File</label>
                                <input type="file" name="statement_letter_path" id="statement_letter_path" class="d-none file-button" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <Label>Curriculum Vitae</Label>
                                <br>
                                <label for="cv_path" class="custom-upload">
                                    <i class="fa fa-cloud-upload"></i> Upload
                                </label>
                                <label id="cv_path_label"class="file-label">No File</label>
                                <input type="file" name="cv_path" id="cv_path" class="d-none file-button" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <Label>Pas Photo</Label>
                                <br>
                                <label for="photo_path" class="custom-upload">
                                    <i class="fa fa-cloud-upload"></i> Upload
                                </label>
                                <label id="photo_path_label"class="file-label">No File</label>
                                <input type="file" name="photo_path" id="photo_path" class="d-none file-button" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-md btn-success"><i class="fa fa-paper-plane"></i> Send</button>
                    </div>
                </form>
            </div>
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
        $('.file-button').change(function() {
            var file = $(this)[0].files[0].name;
            var parent = $(this).parent();
            parent.find('.file-label').text(file);
        });
    </script>
@endpush