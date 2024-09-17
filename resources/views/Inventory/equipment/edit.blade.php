@extends('adminlte::page')

@section('title')
    {{ $title }}
@stop

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@section('content')
    <form action="{{ route('inventory-equipment.update', [$inventory->id]) }}" method="post" enctype="multipart/form-data" id="addInventoryForm">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="Name"
                                    value="{{ $inventory->name }}" class="form-control" required>
                                    <input type="hidden" name="inventory_category_id" value="{{ INVENTORY_CATEGORY_ALAT_BERAT }}">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Tipe</label>
                                    <input type="text" name="type" id="type" class="form-control" placeholder="Tipe" value="{{ $inventory->type }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="production_year">Tahun Pembuatan</label>
                                <input type="number" name="production_year" id="production_year" name="production_year" class="form-control" placeholder="Tahun Pembuatan" value="{{ $inventory->production_year }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="owner_name">Nama Kepemilikan</label>
                                <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="Nama Kepemilkan" value="{{ $inventory->owner_name }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="owner_year">Tahun Kepemilikan</label>
                                <input type="number" class="form-control" id="owner_year" name="owner_year" placeholder="Tahun Kepemilkan" value="{{ $inventory->owner_year }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="location">Lokasi</label>
                                <select name="district_id" id="location" class="form-control">
                                    <option value="0" {{ ($inventory->district_id == 0)? 'selected':'' }}>Provinsi</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" {{ ($inventory->district_id == $district->id)? 'selected':'' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" required>{!! $inventory->description !!}</textarea>
                            </div> --}}
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-save"></i> Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group text-center">
                            <label>Image</label>
                            <div class="form-group">
                                <div class="col-md-12 text-center" id="imageButton">
                                    <img class="img-fit" id="imagePreview"
                                        src="{{ asset('img/no_image_available.jpeg') }}">
                                    <span class="btn btn-default btn-file mt-2">
                                        Choose Photo<input type="file" name="img_path" accept="image/*">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </form>
@stop

@push('js')
    <script>
        $(document).ready(function() {
            selectedValue = $('#inventoryCategoryId').find(':selected').val();
            if (selectedValue == {{ INVENTORY_CATEGORY_ALAT_BERAT }}) {
                $('.condition').show();
            } else {
                $('.condition').hide();
            }
        });
        $('#imageButton').on('change', '.btn-file :file', function() {
            readURL(this, 'imagePreview');
        });

        $(document).on('change', '#inventoryCategoryId', function() {
            selectedValue = $(this).find(':selected').val();
            if (selectedValue == {{ INVENTORY_CATEGORY_ALAT_BERAT }}) {
                $('.condition').show(1000);
            } else {
                $('.condition').hide(1000);
            }
        });
    </script>
@endpush
