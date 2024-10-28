@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Detail Harga Satuan Pekerjaan</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $pekerjaan->title }}</h5>
            <p class="card-text"><strong>Satuan:</strong> {{ $pekerjaan->satuan }}</p>
            <p class="card-text"><strong>Biaya:</strong> {{ number_format($pekerjaan->biaya, 2) }}</p>
        </div>
    </div>

    <h4>Details</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Nama Harga Satuan</th>
                <th>Kode</th>
                <th>Satuan</th>
                <th>Koefisien</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pekerjaan->details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->hargaSatuan->jenis }}</td>
                    <td>{{ $detail->hargaSatuan->nama }}</td>
                    <td>{{ $detail->hargaSatuan->kode }}</td>
                    <td>{{ $detail->hargaSatuan->satuan }}</td>
                    <td>{{ $detail->koefisien }}</td>
                    <td>{{ number_format($detail->hargaSatuan->harga, 2) }}</td>
                    <td>{{ number_format($detail->total_harga, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pekerjaan.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
