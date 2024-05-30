<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Santri</title>
</head>
@use('Carbon\Carbon')

<body>
    <table>
        <thead>
            <tr>
                <th style="font-weight: bold">Nama</th>
                <th style="font-weight: bold">Kelas</th>
                <th style="font-weight: bold">Tanggal Lahir</th>
                <th style="font-weight: bold">Tanggal Keluar</th>
                <th style="font-weight: bold">Jenis Kelamin</th>
                <th style="font-weight: bold">Wali</th>
                <th style="font-weight: bold">Status Santri</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td style="word-wrap: break-word;" width="200px">{{ $item->nama }}</td>
                    <td style="word-wrap: break-word;" width="200px">{{ $item->jenjang->jenjang }}</td>
                    <td style="word-wrap: break-word;" width="200px">
                        {{ Carbon::parse($item->tgl_lahir)->format('Y-m-d') }}</td>
                    <td style="word-wrap: break-word;" width="200px">
                        {{ $item->tgl_keluar !== null ? Carbon::parse($item->tgl_Keluar)->format('Y-m-d') : 'Tidak Ada' }}
                    </td>
                    <td style="word-wrap: break-word;" width="100px">{{ $item->jenis_kelamin }}</td>
                    <td style="word-wrap: break-word;" width="200px">
                        {{ $item->waliRelasi !== null ? $item->waliRelasi->wali->nama : 'Tidak ada' }}
                    </td>
                    <td style="word-wrap: break-word;" width="200px">
                        {{ $item->status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
