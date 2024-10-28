@extends('layouts.front')

@section('title')
    Harga Satuan Dasar
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush


@section('content')
<div class="container">
    <h2 class="text-center">Harga Satuan</h2>

    {{-- District Links for Filtering --}}
    <div class="d-flex justify-content-center mb-4">
        @foreach($districts as $district)
            <a href="{{ route('harga_satuan.index_public', ['district_id' => $district->id]) }}"
               class="btn btn-outline-primary mx-2 {{ $district->id == $selectedDistrictId ? 'active' : '' }}">
                {{ strtoupper($district->name) }}
            </a>
        @endforeach
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th rowspan="2" class="align-middle text-center">NO</th>
                <th rowspan="2" class="align-middle text-center">KODE</th>
                <th rowspan="2" class="align-middle text-center">URAIAN</th>
                <th rowspan="2" class="align-middle text-center">SATUAN</th>
                <th colspan="{{ $kecamatans->count() }}" class="text-center">KAB {{ strtoupper($districts->find($selectedDistrictId)->name) }}</th>
            </tr>
            <tr>
                @foreach($kecamatans as $kecamatan)
                    <th class="text-center">{{ $kecamatan->nama }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($hargaSatuans as $kode => $items)
                @php $item = $items->first(); @endphp
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $item->kode }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">{{ $item->satuan }}</td>

                    {{-- Display harga values or 0 if not available --}}
                    @foreach($kecamatans as $kecamatan)
                        <td class="text-right">
                            {{ number_format($hargaMap[$kode][$kecamatan->id] ?? 0, 2) }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $('.table').DataTable();
    </script>
@endpush
