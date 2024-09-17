@extends('layouts.front')

@section('title')
    {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <label class="font-weight-bold">Tabel {{ $title }}</label>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            @if ($category->id == INVENTORY_CATEGORY_BAHAN_MATERIAL)
                                <th>Jenis Quarry</th>
                                <th>Lokasi Quarry</th>
                                <th>Pemilik Quarry</th>
                                <th>Status Quarry</th>
                            @else
                                <th>Nama Alat</th>
                                <th>Tipe</th>
                                <th>Tahun Pembuatan</th>
                                <th>Nama Kepemilikan</th>
                                <th>Tahun Kepemilikan</th>
                                <th>Lokasi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $inventory)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if ($category->id == INVENTORY_CATEGORY_BAHAN_MATERIAL)
                                    <td>{{ $inventory->type ?? '-' }}</td>
                                    <td>{{ $inventory->view_location }}</td>
                                    <td>{{ $inventory->owner_quarry ?? '-' }}</td>
                                    <td>{{ $inventory->status_quarry ?? '-' }}</td>
                                @else
                                    <td>{{ $inventory->name ?? '-' }}</td>
                                    <td>{{ $inventory->type ?? '-' }}</td>
                                    <td>{{ $inventory->production_year ?? '-' }}</td>
                                    <td>{{ $inventory->owner_name ?? '-' }}</td>
                                    <td>{{ $inventory->owner_year ?? '-' }}</td>
                                    <td>{{ $inventory->view_location }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $('.table').DataTable();
</script>
@endpush
