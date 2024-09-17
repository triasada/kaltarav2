@extends('adminlte::page')
@section('plugins.Datatables', true)

@section('title')
    {{ $title }}
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@push('css')
@endpush

@section('content')
<div class="card">
    <div class="card-header text-right">
        @can('Create ES Data')
            <a href="{{ route('expert-data.import') }}" class="btn btn-sm btn-info"><i class="fa fa-upload"></i> Import
                Data</a>
        @endcan
        <a href="{{ route('expert-data.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah tenaga kerja konstruksi</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kecamatan</th>
                        <th>Pekerjaan</th>
                        <th>Status</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$expertDatas->count())
                        <tr>
                            <td class="text-center" colspan="7">There is no ES Data now</td>
                        </tr>
                    @endif
                    @foreach ($expertDatas as $expertData)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $expertData->name }}</td>
                            <td>{{ $expertData->district->name }}</td>
                            <td>{{ $expertData->job->name }}</td>
                            <td>{{ $expertData->status }}</td>
                            <td>
                                @can('Edit ES Data')
                                    <a href="{{ route('expert-data.edit', [$expertData->id]) }}" class="btn btn-xs btn-warning mt-1"><i class="fa fa-edit"></i> Edit</a>
                                @endcan
                                @can('Delete ES Data')
                                    <form action="{{ route('expert-data.destroy', [$expertData->id]) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-xs btn-danger mt-1"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div id="pagination">
                {{ $expertDatas->links() }}
            </div> --}}
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $('.table').DataTable();
    </script>
@endpush
