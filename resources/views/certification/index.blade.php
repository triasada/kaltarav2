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
        <a href="{{ route('certification.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> New Certification</a>
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
                    @if (!$certifications->count())
                        <tr>
                            <td class="text-center" colspan="7">There is no Certification now</td>
                        </tr>
                    @endif
                    @foreach ($certifications as $certification)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $certification->title }}</td>
                            <td>{{ $certification->start_date->toDateString() }}</td>
                            <td>{{ $certification->end_date->toDateString() }}</td>
                            <td>{{ $certification->registration_start_date->toDateString() }}</td>
                            <td>{{ $certification->registration_end_date->toDateString() }}</td>
                            <td>
                                @can('View Participant Certification')
                                    <a href="{{ route('certification.participants', [$certification->id]) }}" class="btn btn-xs btn-info"><i class="fa fa-user"></i> Participant</a>
                                @endcan
                                @can('Edit Certification')
                                    <a href="{{ route('certification.edit', [$certification->id]) }}" class="btn btn-xs btn-warning mt-1"><i class="fa fa-edit"></i> Edit</a>
                                @endcan
                                @can('Delete Certification')    
                                    <form action="{{ route('certification.destroy', [$certification->id]) }}" method="post">
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
                {{ $certifications->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush