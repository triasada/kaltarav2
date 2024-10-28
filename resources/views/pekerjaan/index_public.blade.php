@extends('layouts.front')

@section('title')
    Harga Satuan Pekerjaan
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="container">
    <h1>Harga Satuan Pekerjaan List</h1>

    <div class="mb-4">
       
        @foreach($districts as $district)
            <a href="{{ route('pekerjaan_public.index', ['district_id' => $district->id]) }}" 
               class="btn {{ $activeDistrictId == $district->id ? 'btn-primary' : 'btn-outline-primary' }} btn-sm">
                {{ $district->name }}
            </a>
        @endforeach
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Satuan</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pekerjaans as $index => $pekerjaan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <a href="{{ route('pekerjaan_public.show', $pekerjaan->id) }}">
                            {{ $pekerjaan->title }}
                        </a>
                    </td>
                    <td>{{ $pekerjaan->satuan }}</td>
                    <td>{{ number_format($pekerjaan->biaya, 2) }}</td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Pekerjaan found.</td>
                </tr>
            @endforelse
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
