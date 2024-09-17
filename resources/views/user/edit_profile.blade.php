@extends('adminlte::page')

@section('plugins.DateTimePicker', true)

@section('title')
{{ $title }}
@endsection

@push('css')
@endpush

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 border-right">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" autocomplete="off" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" autocomplete="off" value="{{ $user->name }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Birthdate</label>
                                <div class="input-group date" id="birthDate" data-target-input="nearest">
                                    <input type="text" name="birth_date" class="form-control datetimepicker-input" data-target="#birthDate" value="{{ $user->birth_date_form }}" placeholder="Birth Date"/>
                                    <div class="input-group-append" data-target="#birthDate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Gender</label>
                                {!! Form::select('gender', GENDER_ARRAY, $user->gender, ['class' => 'form-control', 'placeholder' => 'Choose One']) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Address" autocomplete="off" value="{{ $user->address }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone_number" id="phoneNumber" class="form-control" placeholder="Phone Number" autocomplete="off" value="{{ $user->phone_number }}">
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group text-center">
                            <label>Profile Picture</label>
                            <div class="form-group">
                                <div class="col-md-12 text-center" id="photoButton">
                                    @if($user->photo_profile_path)
                                        <img class="img-fit" id="photoPreview"
                                             src="{{ asset($user->photo_profile_path) }}"/>
                                    @else
                                        <img class="img-fit" id="photoPreview"
                                             src="{{ asset('img/no_image_available.jpeg') }}">
                                    @endif
                                    <span class="btn btn-default btn-file mt-2">
										Choose Photo<input type="file" name="photo" accept="image/*">
									</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        // birthdate 
        $('#birthDate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        // phone number
        $("#phoneNumber").inputFilter(function(value) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
        });

        // photo
        $('#photoButton').on('change', '.btn-file :file', function () {
            readURL(this, 'photoPreview');
        });
    </script>
@endpush