@extends('adminlte::page')

@section('title', 'Harga Satuan Pekerjaan')

@section('content')
<div class="container">
    <a href="{{ route('pekerjaan.create') }}" class="btn btn-primary mb-3">Add New Entry</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Satuan</th>
                <th>Biaya</th>
                <th>Kabupaten (District)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pekerjaans as $pekerjaan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pekerjaan->title }}</td>
                    <td>{{ $pekerjaan->satuan }}</td>
                    <td>{{ number_format($pekerjaan->biaya, 2) }}</td>
                    <td>{{ $pekerjaan->district->name }}</td>
                    <td>
                        <a href="{{ route('pekerjaan.edit', $pekerjaan->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('pekerjaan.show', $pekerjaan->id) }}" class="btn btn-info">Detail</a>
                        <form action="{{ route('pekerjaan.destroy', $pekerjaan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
