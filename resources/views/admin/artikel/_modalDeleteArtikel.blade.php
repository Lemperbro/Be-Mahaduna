<dialog id="delete{{ $key }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
      <form action="{{ route('artikle.delete', ['id' => $item->slug ]) }}" method="POST">
          @csrf
          <h3 class="font-bold text-lg">Hapus Data!</h3>
          <p class="py-4">Apakah anda yakin ingin menghapus artikel ini ?</p>
          <h4 class="font-semibold text-red-600">{{ $item->judul }}</h4>
          <div class="flex gap-2 mt-4 justify-end">
              <label for="DeleteArtikelModalBtn{{ $key }}" class="btn bg-red-700 text-white border-none hover:bg-red-600">Batal</label>
              <button type="submit" class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Hapus</button>
          </div>
      </form>
      <div class="modal-action hidden">
        <form method="dialog">
          <!-- if there is a button in form, it will close the modal -->
          <button class="btn" id="DeleteArtikelModalBtn{{ $key }}">Close</button>
        </form>
      </div>
    </div>
  </dialog>