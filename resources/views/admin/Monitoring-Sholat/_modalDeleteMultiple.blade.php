<dialog id="deleteMonitoringMultiple" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <div>
            <h3 class="font-bold text-lg">Konfirmasi Hapus Data</h3>
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
                    for="btnDeleteMonitorMultiple">Hapus</label>
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
