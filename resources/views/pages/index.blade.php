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
        <a href="{{ route('page.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Create Page</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Summary</th>
                        <th>Created At</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$pages->count())
                        <tr>
                            <td class="text-center" colspan="7">There is no page now</td>
                        </tr>
                    @endif
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->summary }}</td>
                            <td>{{ $page->created_at->toDateTimeString() }}</td>
                            <td>
                                <a href="{{ route('page.edit', [$page->id]) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <form action="{{ route('page.destroy', [$page->id]) }}" method="post">
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
                {{ $pages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush