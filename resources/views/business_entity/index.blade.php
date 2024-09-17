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
        @can('Create Business Entity')
            <a href="{{ route('business-entity.import') }}" class="btn btn-sm btn-info"><i class="fa fa-upload"></i> Import
                Data</a>
        @endcan
        <a href="{{ route('business-entity.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> New Business Entity</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Address</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$businessEntities->count())
                        <tr>
                            <td class="text-center" colspan="7">There is no Business Entity now</td>
                        </tr>
                    @endif
                    @foreach ($businessEntities as $businessEntity)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $businessEntity->name }}</td>
                            <td>{{ $businessEntity->businessType->name }}</td>
                            <td>{{ $businessEntity->address }}</td>
                            <td>
                                @can('Edit Business Entity')
                                    <a href="{{ route('business-entity.edit', [$businessEntity->id]) }}" class="btn btn-xs btn-warning mt-1"><i class="fa fa-edit"></i> Edit</a>
                                @endcan
                                @can('Delete  Business Entity')
                                    <form action="{{ route('business-entity.destroy', [$businessEntity->id]) }}" method="post">
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
                {{ $businessEntities->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush
