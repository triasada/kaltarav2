@extends('layouts.front')

@section('title')
    {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')
    @if ($listData->count())
        <div class="row">
            @foreach ($listData as $job)
            <div class="col-md-6">
                <h3 class="text-center font-weight-bold">{{ $job->name }}</h3>
                <div class="mt-2">
                    <canvas id="myChart{{ $loop->iteration }}"></canvas>
                </div>
            </div>
            @endforeach
            @foreach ($listData as $job)
                <div class="col-md-12">
                    <div class="card mt-5">
                        <div class="card-header">
                            <label class="font-weight-bold">Table {{ $job->name }}</label>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Pekerjaan</th>
                                            <th>Kab/Kota</th>
                                            <th>Klasifikasi SKA</th>
                                            <th>Pendidikan</th>
                                            <th>Tgl Expired</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($job->expertDatas as $data)    
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->name ?? '-' }}</td>
                                                <td>{{ $data->view_gender }}</td>
                                                <td>{{ $data->job->name ?? '-' }}</td>
                                                <td>{{ $data->district->name ?? '-' }}</td>
                                                <td>{{ $data->skaClassification->name ?? '-' }}</td>
                                                <td>{{ $data->educationLevel->name ?? '-' }}</td>
                                                <td>
                                                    @if ($data->expire_date)
                                                        {{ $data->expire_date->format('d M Y') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h5 class="text-center">Data belum tersedia</h5>
    @endif
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        @foreach ($listData as $job)
            var setLabels = [];
            var randomColor = [];
            var setData = [];
            @foreach($job->expertDatas->groupBy('ska_classification_id') as $skaID => $data)
                setLabels.push('{{ $ska->where("id", $skaID)->first()->name }}');
                randomColor.push('{{ $ska->where("id", $skaID)->first()->chart_background }}');
                setData.push('{{ $data->count() }}');
            @endforeach
            const ctx{{ $loop->iteration }} = document.getElementById('myChart{{ $loop->iteration }}');
            const myChart{{ $loop->iteration }} = new Chart(ctx{{ $loop->iteration }}, {
                type: 'bar',
                data: {
                    labels: setLabels,
                    datasets: [{
                        data: setData,
                        backgroundColor:randomColor,
                        borderColor: randomColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        @endforeach
        
        function random(number){
            return Math.floor(Math.random()*number);;
        }

        $('.table').DataTable();
    </script>
@endpush
