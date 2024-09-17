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
                <form action="{{ route('school-major.update', [$major->id]) }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Nama</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama"
                                    required value="{{ $major->name }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Jenjang Pendidikan</label>
                                <select name="school_level_id" id="schoolLevelId" class="form-control" required>
                                    <option value="">Pilih Satu</option>
                                    @foreach ($schoolLevels as $schoolLevel)
                                        <option value="{{ $schoolLevel->id }}" @if($major->school_level_id == $schoolLevel->id) selected @endif>{{ $schoolLevel->name }}</option>
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
    <script src="{{ asset('js/collect.min.js') }}"></script>
    <script>
        var schoolLevels = collect(@json($schoolLevel));
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
