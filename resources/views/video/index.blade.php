@extends('adminlte::page')

@section('title')
    {{ $title }}
@stop

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-right">
                    @can('Create Video')
                        <a href="{{ route('video.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Tambah
                            Video</a>
                    @endcan
                </div>
                <div class="card-body">
                    @if ($videos->count())
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Url</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($videos as $video)
                                        <tr>
                                            <td>{{ $loop->iteration * $videos->currentPage() }}</td>
                                            <td>{{ $video->title }}</td>
                                            <td>{{ $video->url }}</td>
                                            <td class="d-flex">
                                                @can('Edit Video')
                                                    <a href="{{ route('video.edit', [$video->id]) }}" class="btn btn-xs btn-warning mr-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                @endcan
                                                @can('Delete Video')
                                                    <form action="{{ route('video.destroy', [$video->id]) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="text-center">
                                {!! $videos->links() !!}
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <h4>Belum ada video</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
