<dialog id="modalTambahKelas" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white ">
        <form action="{{ route('kelas.create') }}" method="POST">
            @csrf
            <h3 class="font-bold text-lg">Tambah Kelas</h3>
            <div class="my-4">
                <label for="kelas">Masukan Kelas</label>
                <input type="text" name="kelas" id="kelas" class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2" required>
            </div>
            <button id="btnSimpanTambahKelas" type="submit" class="hidden"></button>
        </form>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Batal</button>
                <label class="btn bg-red-700 text-white border-none hover:bg-red-600" for="btnSimpanTambahKelas">Simpan</label>
            </form>
        </div>
    </div>
</dialog>