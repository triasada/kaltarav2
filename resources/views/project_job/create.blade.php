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
                <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" placeholder="Nama" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="jobType">Jenis Pekerjaan</label>
                                <select name="job_type_id" id="jobType" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($jobTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Instansi Pelaksana</label>
                                <select name="job_instantion_id" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($jobInstantions as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bidang Yang Menangani</label>
                                <select name="job_desk_id" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($jobDesks as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Lokasi Pekerjaan</label>
                                <select name="district_id" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($districts as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Tahun Anggaran</label>
                                <input type="number" name="year" id="year" class="form-control"
                                    placeholder="Tahun Anggaran" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Jenis Kontrak</label>
                                <select name="contract_type_id" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($contractTypes as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Tanggal Kontrak</label>
                                <input id="startDate" name="start_date" class="form-control" required placeholder="Tangal Kontrak" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Tanggal Selesai Kontrak</label>
                                <input id="endDate" name="end_date" class="form-control" required placeholder="Tanggal Selesai Kontrak" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nilai Pekerjaan</label>
                                <input type="text" name="value" id="value" placeholder="Nilai Pekerjaan"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Sumber dana</label>
                                <select name="source_id" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($sources as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $('#startDate').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mmm-yyyy'
        });
        $('#endDate').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mmm-yyyy'
        });
    </script>
@endpush
