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
        <a href="{{ route('post.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Create Post</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Creator</th>
                        <th>Status</th>
                        <th>Published At</th>
                        <th>Created At</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$posts->count())
                        <tr>
                            <td class="text-center" colspan="7">There is no posts now</td>
                        </tr>
                    @endif
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->postCategory->name }}</td>
                            <td>{{ $post->creator->name }}</td>
                            <td>{{ $post->content->contentStatus->name }}</td>
                            <td>{{ $post->content->published_at->toDateTimeString() }}</td>
                            <td>{{ $post->content->created_at->toDateTimeString() }}</td>
                            <td>
                                <a href="{{ route('post.edit', [$post->id]) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                <form action="{{ route('post.destroy', [$post->id]) }}" method="post">
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
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush