@use('Carbon\Carbon')
<dialog id="detail{{ $key }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <div action="{{ route('kelola-pembayaran.delete.tagihan', ['id' => $item->tagihan_id]) }}" method="POST">
            @csrf
            <h3 class="font-bold text-lg">Detail Tagihan</h3>
            <div class="mt-4">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <h1 class="font-semibold">Nama Santri</h1>
                        <p class="text-gray-600 capitalize">{{ $item->santri->nama }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Jenjang</h1>
                        <p class="text-gray-600 capitalize">{{ $item->santri->jenjang->jenjang }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Jenis Kelamin</h1>
                        <p class="text-gray-600 capitalize">{{ $item->santri->jenis_kelamin }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Tagihan</h1>
                        <p class="text-gray-600 capitalize"> Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Bayar</h1>
                        <p class="text-gray-600 capitalize">
                            {{ $item->transaksi !== null ? 'Rp. ' . number_format($item->transaksi->pay, 0, ',', '.') : 'Belum ada' }}
                        </p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Tagihan Bulan</h1>
                        <p class="text-gray-600 capitalize">
                            {{ Carbon::parse($item->date)->locale('id')->isoFormat(' MMMM YYYY') }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Jalur Pembayaran</h1>
                        <p class="text-gray-600 capitalize">{{ $item->payment_type ?? 'Belum ada' }}</p>
                    </div>
                    <div>
                        <h1 class="font-semibold">Status</h1>
                        <div class="text-gray-600 capitalize">
                            @if ($item->status === 'sudah dibayar')
                                <p class=" text-green-500 inline-block w-full whitespace-nowrap">
                                    Sudah Dibayar
                                </p>
                            @elseif ($item->status === 'menunggu dibayar')
                                <p class=" text-yellow-500 inline-block w-full whitespace-nowrap">
                                    Menunggu Dibayar
                                </p>
                            @else
                                <p class=" text-red-500 inline-block w-full whitespace-nowrap">
                                    Belum Dibayar
                                </p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <h1 class="font-semibold">Tagihan Di Buat</h1>
                        <p class="text-gray-600 capitalize">
                            {{ Carbon::parse($item->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <h1 class="font-semibold">Katerangan Tagihan</h1>
                    <p class="text-gray-600 capitalize">
                        {{ $item->label }}</p>
                </div>

            </div>
            <div class="flex gap-2 mt-4 justify-end">
                <label for="detailCloseModalBtn{{ $key }}"
                    class="btn bg-red-700 text-white border-none hover:bg-red-600">Tutup</label>
            </div>
        </div>
        <div class="modal-action hidden">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn" id="detailCloseModalBtn{{ $key }}">Close</button>
            </form>
        </div>
    </div>
</dialog>
