<dialog id="deleteTagihan{{ $key }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <form action="{{ route('kelola-pembayaran.delete.tagihan', ['id' => $item->tagihan_id]) }}" method="POST">
            @csrf
            <h3 class="font-bold text-lg">Hapus Tagihan</h3>
            <div class="mt-4">
                <h1 class="mt-1">Nama Santri : {{ $item->santri->nama }}</h1>
                <h1 class="mt-1">Jenjang : {{ $item->santri->jenjang->jenjang }}</h1>
                <h1 class="mt-1">Tagihan : Rp. {{ number_format($item->price, 0, ',', '.') }}</h1>
            </div>
            <div class="flex gap-2 mt-4 justify-end">
                <label for="deleteTagihanCloseModalBtn{{ $key }}"
                    class="btn bg-red-700 text-white border-none hover:bg-red-600">Batal</label>
                <button type="submit"
                    class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Hapus</button>
            </div>
        </form>
        <div class="modal-action hidden">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn" id="deleteTagihanCloseModalBtn{{ $key }}">Close</button>
            </form>
        </div>
    </div>
</dialog>
