<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Sertifikasi</th>
                <th>Nama</th>
                <th>KTP</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>
                <th>Alamat</th>
                <th>Kabupaten/Kota</th>
                <th>Nomor HP</th>
                <th>Email</th>
                <th>Pendidikan</th>
                <th>Sertifikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $participant->training->title }}</td>
                    <td>{{ $participant->name }}</td>
                    <td>{{ $participant->id_number }}</td>
                    <td>{{ $participant->birth_date->toDateString() }}</td>
                    <td>{{ $participant->view_gender }}</td>
                    <td>{{ $participant->job->name }}</td>
                    <td>{{ $participant->address }}</td>
                    <td>{{ $participant->district->name }}</td>
                    <td>{{ $participant->phone_number }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>{{ $participant->educationLevel->name }}</td>
                    <td>{{ $participant->certification }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>