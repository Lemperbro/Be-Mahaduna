<dialog id="addKategori" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <form action="{{ route('artikel.kategori.create') }}" method="POST">
            @csrf
            <h3 class="font-bold text-lg">Tambah Data kategori</h3>
            <div class="mt-4">
                <label for="kategori">Kategori</label>
                <div class="mt-1">
                    <input type="text" name="kategori" id="kategori"
                        class="w-full p-2 rounded-md bg-white border border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('kategori')
                            peer
                        @enderror" required>
                </div>
                @error('kategori')
                    <p class="peer-invalid:visible text-red-700 font-light">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex gap-2 mt-4 justify-end">
                <label for="addKategoriModalBtlBtn"
                    class="btn bg-red-700 text-white border-none hover:bg-red-600">Batal</label>
                <button type="submit"
                    class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Simpan</button>
            </div>
        </form>
        <div class="modal-action hidden">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn" id="addKategoriModalBtlBtn">Close</button>
            </form>
        </div>
    </div>
</dialog>
