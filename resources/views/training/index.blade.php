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
        <a href="{{ route('training.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> New Training</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Registration Start Date</th>
                        <th>Registration End Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$trainings->count())
                        <tr>
                            <td class="text-center" colspan="7">There is no training now</td>
                        </tr>
                    @endif
                    @foreach ($trainings as $training)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $training->title }}</td>
                            <td>{{ $training->start_date->toDateString() }}</td>
                            <td>{{ $training->end_date->toDateString() }}</td>
                            <td>{{ $training->registration_start_date->toDateString() }}</td>
                            <td>{{ $training->registration_end_date->toDateString() }}</td>
                            <td>
                                @can('View Participant training')
                                    <a href="{{ route('training.participants', [$training->id]) }}" class="btn btn-xs btn-info"><i class="fa fa-user"></i> Participant</a>
                                @endcan
                                @can('Edit training')
                                    <a href="{{ route('training.edit', [$training->id]) }}" class="btn btn-xs btn-warning mt-1"><i class="fa fa-edit"></i> Edit</a>
                                @endcan
                                @can('Delete training')    
                                    <form action="{{ route('training.destroy', [$training->id]) }}" method="post">
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
                {{ $trainings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush