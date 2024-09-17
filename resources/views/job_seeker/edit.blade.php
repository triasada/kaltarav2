@extends('adminlte::page')

@section('title')
    {{ $title }}
@stop

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@push('css')
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('job-seeker.update', [$jobSeeker->id]) }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nama</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama"
                                    required value="{{ $jobSeeker->name }}">
                            </div>
                            <div class="col-md-6">
                                <label>NIK</label>
                                <input type="number" name="id_number" id="idNumber" class="form-control" placeholder="NIK"
                                    required value="{{ $jobSeeker->id_number }}">
                            </div>
                            <div class="col-md-6">
                                <label>Tanggal Lahir</label>
                                <input type="text" name="birth_date" id="birthDate" class="form-control"
                                    placeholder="Tanggal Lahir" required
                                    value="{{ $jobSeeker->birth_date->format('d-M-Y') }}">
                            </div>
                            <div class="col-md-6">
                                <label>Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach (GENDER_ARRAY_INDONESIAN as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $key == $jobSeeker->gender ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Pekerjaan</label>
                                <select name="job_seeker_job_type_id" id="jobType" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($jobTypes as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $value->id == $jobSeeker->job_seeker_job_type_id ? 'selected' : '' }}>
                                            {{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Kabupaten / KOta</label>
                                <select name="district_id" id="districtId" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($districts as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $value->id == $jobSeeker->district_id ? 'selected' : '' }}>
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Alamat</label>
                                <textarea name="address" id="address" cols="30" rows="3" class="form-control" required>{{ $jobSeeker->address }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Nomor HP (WA)</label>
                                <input type="number" name="phone_number" id="phone_number" class="form-control"
                                    placeholder="Nomor HP (WA)" required value="{{ $jobSeeker->phone_number }}">
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                    required value="{{ $jobSeeker->email }}">
                            </div>
                            <div class="col-md-6">
                                <label>Pendidikan</label>
                                <select name="job_seeker_school_level_id" id="job_seeker_school_level_id"
                                    class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($schoolLevels as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $value->id == $jobSeeker->job_seeker_school_level_id ? 'selected' : '' }}>
                                            {{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Sertifikasi</label>
                                <select name="certification_type_id" id="certification_type_id" class="form-control"
                                    required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($certificationTypes as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $value->id == $jobSeeker->certification_type_id ? 'selected' : '' }}>
                                            {{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Klasifikasi Sertifikasi</label>
                                @if ($jobSeeker->certification_type_id == CLASSIFICATION_TYPE_SKA)
                                    <select name="class_certification_type_id" id="class_certification_type_id"
                                        class="form-control" required>
                                        <option value="">Pilih Satu</option>
                                        @foreach ($ska as $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == $jobSeeker->class_certification_type_id ? 'selected' : '' }}>
                                                {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                @elseif($jobSeeker->certification_type_id == CLASSIFICATION_TYPE_SKA)
                                    <select name="class_certification_type_id" id="class_certification_type_id"
                                        class="form-control" required>
                                        <option value="">Pilih Satu</option>
                                        @foreach ($skt as $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == $jobSeeker->class_certification_type_id ? 'selected' : '' }}>
                                                {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                @elseif($jobSeeker->certification_type_id == 3)
                                    <select name="class_certification_type_id" id="class_certification_type_id"
                                        class="form-control">
                                        <option value="0">Tidak Tersertifikasi</option>
                                    </select>
                                @else
                                    <select name="class_certification_type_id" id="class_certification_type_id"
                                        class="form-control" required>
                                        <option value="">Pilih Satu</option>
                                    </select>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label>Kode Sub Klasifikasi</label>
                                <input type="text" name="sub_classification_code" id="sub_classification_code"
                                    class="form-control" placeholder="Kode Sub Klasifikasi" required
                                    value="{{ $jobSeeker->sub_classification_code }}">
                            </div>
                            <div class="col-md-6">
                                <label>Nama Sub Klasifikasi</label>
                                <input type="text" name="sub_classification_name" id="sub_classification_name"
                                    class="form-control" placeholder="Nama Sub Klasifikasi" required
                                    value="{{ $jobSeeker->sub_classification_name }}">
                            </div>
                            <div class="col-md-6">
                                <label>Kualifikasi</label>
                                <select name="qualification_id" id="qualification_id" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($qualifications as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $value->id == $jobSeeker->qualification_id ? 'selected' : '' }}>
                                            {{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script>
    <script src="{{ asset('js/collect.min.js') }}"></script>
    <script>
        var ska = collect(@json($ska));
        var skt = collect(@json($skt));
        $('#birthDate').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mmm-yyyy'
        });

        $(document).on('change', '#certification_type_id', function() {
            var selected = $(this).find('option:selected').val();
            var options = '<option value="">Pilih Satu</option>';
            if (selected == {{ CLASSIFICATION_TYPE_SKA }}) {
                // class_certification_type_id
                ska.each(function(item) {
                    options = options + '<option value="' + item.id + '">' + item.name + '</option>';
                });
                $('#class_certification_type_id').prop('required', true);
            } else if (selected == {{ CLASSIFICATION_TYPE_SKT }}) {
                skt.each(function(item) {
                    options = options + '<option value="' + item.id + '">' + item.name + '</option>';
                });
                $('#class_certification_type_id').prop('required', true);
            } else if (selected == 3) {
                options = options + '<option value="0">Tidak Tersertifikasi</option>';
                $('#class_certification_type_id').prop('required', false);
            } else {
                $('#class_certification_type_id').prop('required', true);
            }
            $('#class_certification_type_id').html(options);
        });
    </script>
@endpush
