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
        <a href="{{ route('training.participants.excel', [$training->id]) }}" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download Excel</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Certification</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Job</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $participant)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $participant->training->title }}</td>
                            <td>{{ $participant->name }}</td>
                            <td>{{ $participant->email }}</td>
                            <td>{{ $participant->job->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush