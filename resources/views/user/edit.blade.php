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
        <form action="{{ route('user.update', [$user->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6 form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email" required value="{{ $user->email }}">
                </div>
                {{-- <div class="col-md-6 form-group">
                  <label for="email">Password</label>
                  <input type="text" name="password" id="password" class="form-control" readonly value="{{ uniqid() }}">
                </div> --}}
                <div class="col-md-6 form-group">
                  <label for="name">Nama</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Nama" required value="{{ $user->name }}">
                </div>
                <div class="col-md-6 form-group">
                    <label>Role</label>
                    {!! Form::select('role_id', $roles, ($user->roles->first())?$user->roles->first()->id:null, ['class' => 'form-control', 'placeholder' => 'Choose One', 'required']) !!}
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Kota</label>
                    {!! Form::select('district', $districts, $user->district_id, ['class' => 'form-control', 'placeholder' => 'Pilih Kota', 'required']) !!}
                </div>
        
                <div class="col-md-6 form-group">
                    <label for="">SK</label>
                    {!! Form::text('sk', $user->sk, ['class' => 'form-control', 'placeholder' => 'SK', 'required']) !!}
                </div>
                <div class="col-md-6 form-group">
                    <label>Birthdate</label>
                    <div class="input-group date" id="birthDate" data-target-input="nearest">
                        <input type="text" name="birth_date" class="form-control datetimepicker-input" data-target="#birthDate" placeholder="Birth Date" autocomplete="off" value="{{ ($user->birth_date)?$user->birth_date->format('d-m-Y'):'' }}">
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
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" id="phoneNumber" class="form-control" placeholder="Phone Number" autocomplete="off" value="{{ $user->phone_number }}">
                </div>
                <div class="col-md-6 form-group">
                    <label>Address</label>
                    {{-- <textarea name="address" id="address" class="form-control" required></textarea> --}}
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" autocomplete="off" required value="{{ $user->address }}">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
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
    </script>
@endpush