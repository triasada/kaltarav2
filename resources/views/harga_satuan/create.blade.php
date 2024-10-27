@extends('adminlte::page')
@section('title', 'Tambah Harga Satuan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah/Edit Harga Satuan</h3>
                </div>

                <div class="card-body">
                    <form action="{{ isset($hargaSatuan) ? route('harga_satuan.update', $hargaSatuan->id) : route('harga_satuan.store') }}" method="POST">
                        @csrf
                        @if(isset($hargaSatuan))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="kode">Kode:</label>
                            <input type="text" class="form-control" name="kode" id="kode" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" name="nama" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis:</label>
                            <select class="form-control" name="jenis" id="jenis" required>
                                <option value="">Pilih Jenis</option>
                                
                                    <option value="BAHAN">Bahan</option>
                                    <option value="UPAH">Upah</option>
                                    <option value="ALAT">Alat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan:</label>
                            <input type="text" class="form-control" name="satuan" id="satuan" required>
                        </div>
                        <div class="form-group">
                            <label for="kabupaten_id">Kabupaten:</label>
                            <select class="form-control" name="kabupaten_id" id="kabupaten_id" required>
                                <option value="">Pilih Kabupaten</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}" 
                                        {{ isset($hargaSatuan) && $hargaSatuan->kabupaten_id == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kecamatan_id">Kecamatan:</label>
                            <select class="form-control" name="kecamatan_id" id="kecamatan_id" required>
                                <option value="">Pilih Kecamatan</option>
                                @if(isset($kecamatans))
                                    @foreach($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}" 
                                            {{ isset($hargaSatuan) && $hargaSatuan->kecamatan_id == $kecamatan->id ? 'selected' : '' }}>
                                            {{ $kecamatan->nama }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga:</label>
                            <input type="number" class="form-control" name="harga" id="harga" 
                                   value="{{ isset($hargaSatuan) ? $hargaSatuan->harga : '' }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#kabupaten_id').on('change', function() {
            var kabupaten_id = $(this).val();
            if(kabupaten_id) {
                $.ajax({
                    url: '/get-kecamatan/' + kabupaten_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#kecamatan_id').empty();
                        $('#kecamatan_id').append('<option value="">Pilih Kecamatan</option>');
                        $.each(data, function(key, value) {
                            $('#kecamatan_id').append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                        });
                    }
                });
            } else {
                $('#kecamatan_id').empty();
                $('#kecamatan_id').append('<option value="">Pilih Kecamatan</option>');
            }
        });
    });
</script>
@endpush
