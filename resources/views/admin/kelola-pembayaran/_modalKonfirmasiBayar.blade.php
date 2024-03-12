<dialog id="konfirmasiBayar{{ $key }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <form action="{{ route('kelola-pembayaran.konfirmasi', ['id' => $item->tagihan_id]) }}" method="POST">
            @csrf
            <h3 class="font-bold text-lg">Konfirmasi Pembayaran</h3>
            <h1 class="mt-4">Nama Santri : {{ $item->santri->nama }}</h1>
            <div class="mt-2">
                <label for="payment_type">Tipe Pembayaran</label>
                <select name="payment_type" id="payment_type" class="w-full mt-1">
                    <option value="cash" selected>Cash</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>
            <div class="flex gap-2 mt-4 justify-end">
                <label for="KonfirmasiPembayaranCloseModalBtn{{ $key }}"
                    class="btn bg-red-700 text-white border-none hover:bg-red-600">Batal</label>
                <button type="submit"
                    class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Konfirmasi</button>
            </div>
        </form>
        <div class="modal-action hidden">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn" id="KonfirmasiPembayaranCloseModalBtn{{ $key }}">Close</button>
            </form>
        </div>
    </div>
</dialog>
