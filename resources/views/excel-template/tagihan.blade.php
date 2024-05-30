<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tagihan</title>
</head>
@use('Carbon\Carbon')

<body>
    <table>
        <thead>
            <tr>
                <th style="font-weight: bold">Nama</th>
                <th style="font-weight: bold">Kelas</th>
                <th style="font-weight: bold">Status</th>
                <th style="font-weight: bold">Wali</th>
                <th style="font-weight: bold">Nomor Telphone Wali</th>
                <th style="font-weight: bold">Keterangan Tagihan</th>
                <th style="font-weight: bold">Tagihan</th>
                <th style="font-weight: bold">Tagihan Untuk Bulan</th>
                <th style="font-weight: bold">Tagihan dibuat</th>
                <th style="font-weight: bold">Status Tagihan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td style="word-wrap: break-word;" width="200px">{{ $item->santri->nama }}</td>
                    <td style="word-wrap: break-word;" width="200px">{{ $item->santri->jenjang->jenjang }}</td>
                    <td style="word-wrap: break-word;" width="100px">{{ $item->santri->status }}</td>
                    <td style="word-wrap: break-word;" width="200px">{{ $item->santri->waliRelasi !== null ? $item->santri->waliRelasi->wali->nama : 'Tidak ada' }}
                    </td>
                    <td style="word-wrap: break-word;" width="200px">{{ $item->santri->waliRelasi !== null ? $item->santri->waliRelasi->wali->telp : 'Tidak ada' }}
                    </td>
                    <td style="word-wrap: break-word;" width="400px">{{ $item->label }}</td>
                    <td style="word-wrap: break-word;" width="100px">{{ number_format($item->price, 0,) }}</td>
                    <td style="word-wrap: break-word;" width="200px">{{ Carbon::parse($item->date)->locale('id')->isoFormat(' MMMM YYYY') }}</td>
                    <td style="word-wrap: break-word;" width="200px">{{ Carbon::parse($item->created_at)->format('Y-m-d H:i') }}</td>
                    <td style="word-wrap: break-word;" width="200px">
                        @if ($item->transaksi !== null)
                            @if ($item->transaksi->payment_status == 'PAID')
                                Sudah Dibayar
                            @endif
                        @else
                            Belum dibayar
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
