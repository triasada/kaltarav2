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
                <form action="{{ route('school.update', [$school->id]) }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nama</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama"
                                    required value="{{ $school->name }}">
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label>Jenjang Pendidikan</label>
                                <select name="school_level_id" id="schoolLevelId" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($schoolLevels as $schoolLevel)
                                        <option value="{{ $schoolLevel->id }}" @if($school->school_level_id == $schoolLevel->id) selected @endif>{{ $schoolLevel->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            {{-- <div class="form-group col-md-6">
                                <label>Jurusan</label>
                                <select name="school_major_id" id="schoolMajorId" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($school->schoolLevel->schoolMajors as $major)
                                        <option value="{{ $major->id }}" {{ $major->id == $school->school_major_id? 'selected':'' }}>{{ $major->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label>Kota</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="Kota"
                                    required value="{{ $school->city }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Alamat</label>
                                <textarea name="address" id="address" cols="30" rows="3" class="form-control" required>
                                    {{ $school->address }}
                                </textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone"
                                    required value="{{ $school->phone }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                    required value="{{ $school->email }}">
                            </div>
                            {{-- <div class="form-group col-md-12">
                                <label>Jumlah Lulusan Pertahun</label>
                                <div class="form-group row">
                                    <label for="man" class="col-sm-1 col-form-label">Laki-laki</label>
                                    <div class="col-sm-3">
                                        <input type="number" name="graduate_amount_man"
                                            placeholder="Jumlah Lulusan Laki-laki" class="form-control" id="man"
                                            required value="{{ $school->graduate_amount_man }}">
                                    </div>
                                    <label for="women" class="col-sm-1 col-form-label">Wanita</label>
                                    <div class="col-sm-3">
                                        <input type="number" name="graduate_amount_female"
                                            placeholder="Jumlah Lulusan Wanita" class="form-control" id="women"
                                            required value="{{ $school->graduate_amount_female }}">
                                    </div>
                                    <label for="total" class="col-sm-1 col-form-label">Total</label>
                                    <div class="col-sm-3">
                                        <input type="number" name="graduate_amount_total"
                                            placeholder="Total Jumlah Lulusan" class="form-control" id="total" required value="{{ $school->graduate_amount_total }}">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-12 form-group">
                                <label>Link Website</label>
                                <input type="text" name="website" id="website" class="form-control" placeholder="Link Website" value="{{ $school->website }}" required>
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
    <script src="{{ asset('js/collect.min.js') }}"></script>
    <script>
        var schoolLevels = collect(@json($schoolLevels));
        $(document).on('change', '#schoolLevelId', function ()
        {
            var selectedId = $(this).find('option:selected').val();
            var majors = schoolLevels.where('id', parseInt(selectedId)).first().school_majors;
            majors = collect(majors);
            var options = '<option value="">Pilih Satu</option>';
            majors.each(function (major)
            {
                options = options + '<option value="'+major.id+'">'+major.name+'</option>';
            });

            $('#schoolMajorId').html(options);
        });
    </script>
@endpush
