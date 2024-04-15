<dialog id="deleteMultiple" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <div>
            <h3 class="font-bold text-lg">Konfirmasi Hapus Data</h3>
            <div class="mt-2">
                <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="font-semibold">
                        Peringatan: Menghapus Santri akan menghapus data monitoring yang terkait.
                    </div>
                </div>
            </div>
            <p class="mt-4">Apakah kamu yakin mau menghapus data ini?</p>
            <div class="flex gap-2 mt-1">
                <h3>Jumlah data yang akan dihapus : </h3>
                <span id="jumlahDataMultipleHapusMultiple"></span>
            </div>
        </div>
        <div class="modal-action">
            <form method="dialog">

                <!-- if there is a button in form, it will close the modal -->
                <button class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Batal</button>
                <label class="btn bg-red-700 text-white border-none hover:bg-red-600"
                    for="btnDeleteMultiple">Hapus</label>
            </form>
        </div>
    </div>
</dialog>
@push('scripts')
    <script>
        $(document).ready(function() {
            const jumlahDataTitleArea = $('#jumlahDataMultipleHapusMultiple');
            const btnAlert = $('#btnAlertDeleteMultiple');
            btnAlert.on('click', function() {
                const jumlahDataChecked = $('.checkboxValue:checked').length;
                jumlahDataTitleArea.html(jumlahDataChecked)
            });
        });
    </script>
@endpush
