@extends('adminlte::page')
@section('plugins.Datatables', true)

@section('title')
    {{ $title }}
@stop

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@section('content')
    <div class="card">
        @can('Create Inventory')
            <div class="card-header text-right">
                <a href="{{ route('inventory-equipment.import') }}" class="btn btn-xs btn-info">
                    <i class="fa fa-upload"></i> Import Inventory
                </a>
                <a href="{{ route('inventory-equipment.create') }}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> Add Inventory
                </a>
            </div>
        @endcan
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="inventoryTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>Type</th>
                            <th>Tahun Pembuatan</th>
                            <th>Nama Kepemilikan</th>
                            <th>Tahun Kepemilikan</th>
                            <th>Lokasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $inventory)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $inventory->name }}</td>
                                <td>{{ $inventory->type }}</td>
                                <td>{{ $inventory->production_year }}</td>
                                <td>{{ $inventory->owner_name }}</td>
                                <td>{{  $inventory->owner_year  }}</td>
                                <td>{{  $inventory->view_location  }}</td>
                                <td class="d-flex">
                                    @can('Edit Inventory')
                                        <a href="{{ route('inventory-equipment.edit', [$inventory->id]) }}"
                                            class="btn btn-xs btn-warning">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    @endcan
                                    @can('Delete Inventory')
                                        <form action="{{ route('inventory-equipment.destroy', [$inventory->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger ml-1">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $('#inventoryTable').DataTable();
    </script>
@endpush
