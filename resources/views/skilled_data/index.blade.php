@extends('adminlte::page')

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
        <a href="{{ route('skilled-data.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> New ES Data</a>
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
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$skilledDatas->count())
                        <tr>
                            <td class="text-center" colspan="7">There is no ES Data now</td>
                        </tr>
                    @endif
                    @foreach ($skilledDatas as $skilledData)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $skilledData->name }}</td>
                            <td>{{ $skilledData->district->name }}</td>
                            <td>{{ $skilledData->job->name }}</td>
                            <td>
                                @can('Edit ES Data')
                                    <a href="{{ route('skilled-data.edit', [$skilledData->id]) }}" class="btn btn-xs btn-warning mt-1"><i class="fa fa-edit"></i> Edit</a>
                                @endcan
                                @can('Delete ES Data')    
                                    <form action="{{ route('skilled-data.destroy', [$skilledData->id]) }}" method="post">
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
            <div id="pagination">
                {{ $skilledDatas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush