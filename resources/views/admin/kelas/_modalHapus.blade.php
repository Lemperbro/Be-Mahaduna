<dialog id="modalHapusKelas{{ $key }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white ">
        <form action="{{ route('kelas.delete', ['id' => $item->jenjang_id]) }}" method="POST">
            @csrf
            <h1 class="mb-2 font-semibold text-xl">Hapus Data</h1>
            <h1 class="my-4">Apakah anda yakin mau menghapus data ini ?</h1>
            <button id="btnHapusKelas{{ $key }}" type="submit" class="hidden"></button>
        </form>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Batal</button>
                <label class="btn bg-red-700 text-white border-none hover:bg-red-600" for="btnHapusKelas{{ $key }}">Hapus</label>
            </form>
        </div>
    </div>
</dialog>