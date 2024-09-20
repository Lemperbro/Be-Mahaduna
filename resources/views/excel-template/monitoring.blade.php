<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Monitoring</title>
</head>
@use('Carbon\Carbon')

<body>
    <table>
        <thead>
            <tr>
                <th style="font-weight: bold">Nama</th>
                <th style="font-weight: bold">Kelas</th>
                <th style="font-weight: bold">Tidak hadir</th>
                <th style="font-weight: bold">Terlambat</th>
                <th style="font-weight: bold">Kategori Data</th>
                <th style="font-weight: bold">Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td style="word-wrap: break-word;" width="200px">{{ $item->santri->nama }}</td>
                    <td style="word-wrap: break-word;" width="200px">{{ $item->santri->jenjang->jenjang }}</td>
                    <td style="word-wrap: break-word;" width="50px">
                        {{ $item->tidak_hadir }}</td>
                    <td style="word-wrap: break-word;" width="50px">
                        {{ $item->terlambat }}
                    </td>
                    <td style="word-wrap: break-word;" width="150px">{{ $item->kategori }}</td>
                    <td style="word-wrap: break-word;" width="200px">
                        {{ Carbon::parse($item->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
