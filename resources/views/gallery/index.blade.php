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
        <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add Gallery</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Published At</th>
                        <th>Created At</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$galleries->count())
                        <tr>
                            <td class="text-center" colspan="7">There is no Gallery now</td>
                        </tr>
                    @endif
                    @foreach ($galleries as $gallery)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $gallery->title }}</td>
                            <td>{{ $gallery->description }}</td>
                            <td>{{ $gallery->content->contentStatus->name }}</td>
                            <td>{{ $gallery->content->published_at->toDateTimeString() }}</td>
                            <td>{{ $gallery->content->created_at->toDateTimeString() }}</td>
                            <td>
                                <a href="{{ route('gallery.edit', [$gallery->id]) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <form action="{{ route('gallery.destroy', [$gallery->id]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-danger mt-1"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="pagination">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush