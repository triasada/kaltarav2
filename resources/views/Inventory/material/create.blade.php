@extends('adminlte::page')

@section('title')
    {{ $title }}
@stop

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@section('content')
    <form action="{{ route('inventory-material.store') }}" method="post" enctype="multipart/form-data" id="addInventoryForm">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" placeholder="Nama"
                                    value="{{ old('name') }}" class="form-control" required>
                                    <input type="hidden" name="inventory_category_id" value="{{ INVENTORY_CATEGORY_BAHAN_MATERIAL }}">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Jenis Quarry</label>
                                    <input type="text" name="type" id="type" class="form-control" placeholder="Jenis Quarry" value="{{ old('type') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="owner_quarry">Pemilik Quarry</label>
                                <input type="text" class="form-control" id="owner_quarry" name="owner_quarry" placeholder="Pemilik Quarry" value="{{ old('owner_quarry') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="status_quarry">Status Quarry</label>
                                <input type="text" class="form-control" id="status_quarry" name="status_quarry" placeholder="Status Quarry" value="{{ old('status_quarry') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="location">Lokasi</label>
                                <select name="district_id" id="location" class="form-control">
                                    <option value="0">Provinsi</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" required>{!! old('description') !!}</textarea>
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
