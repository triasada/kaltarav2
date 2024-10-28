@extends('layouts.front')

@section('title')
    Harga Satuan Pekerjaan detail
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush


@section('content')
<div class="container">
    <h1>{{ $pekerjaan->title }}</h1>
    <p><strong>Satuan:</strong> {{ $pekerjaan->satuan }}</p>
    <p><strong>Biaya:</strong> {{ number_format($pekerjaan->biaya, 2) }}</p>

    <h4>Details</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Harga Satuan</th>
                <th>Harga Satuan</th>
                <th>Koefisien</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pekerjaan->details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->hargaSatuan->nama }}</td>
                    <td>{{ number_format($detail->hargaSatuan->harga, 2) }}</td>
                    <td>{{ $detail->koefisien }}</td>
                    <td>{{ number_format($detail->total_harga, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pekerjaan.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection



@push('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $('.table').DataTable();
    </script>
@endpush
