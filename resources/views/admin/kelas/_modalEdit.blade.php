<dialog id="modalEditKelas{{ $key }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white ">
        <form action="{{ route('kelas.update', ['id' => $item->jenjang_id]) }}" method="POST">
            @csrf
            <h3 class="font-bold text-lg">Ubah Kelas</h3>
            <h1 class="font-semibold mt-4 capitalize">{{ $item->jenjang }}</h1>
            <div class="my-4">
                <label for="kelas">Kelas</label>
                <input type="text" name="kelas" id="kelas" value="{{ $item->jenjang }}" class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2" required>
            </div>
            <button id="btnSimpanEditKelas{{ $key }}" type="submit" class="hidden"></button>
        </form>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Batal</button>
                <label class="btn bg-red-700 text-white border-none hover:bg-red-600" for="btnSimpanEditKelas{{ $key }}">Simpan</label>
            </form>
        </div>
    </div>
</dialog>