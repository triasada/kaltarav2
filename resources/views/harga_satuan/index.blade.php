@extends('adminlte::page')

@section('title', 'Harga Satuan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Harga Satuan</h3>
                    <a href="{{ route('harga_satuan.create') }}" class="btn btn-primary float-right">Tambah Harga Satuan</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Satuan</th>
                                <th>Kabupaten</th>
                                <th>Kecamatan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hargaSatuans as $hargaSatuan)
                                <tr>
                                    <td>{{ $hargaSatuan->kode }}</td>
                                    <td>{{ $hargaSatuan->nama }}</td>
                                    <td>{{ $hargaSatuan->jenis }}</td>
                                    <td>{{ $hargaSatuan->satuan }}</td>
                                    <td>{{ $hargaSatuan->kabupaten->name }}</td>
                                    <td>{{ $hargaSatuan->kecamatan->nama }}</td>
                                    <td>{{ $hargaSatuan->harga }}</td>
                                    <td>
                                        <a href="{{ route('harga_satuan.edit', $hargaSatuan->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('harga_satuan.destroy', $hargaSatuan->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
