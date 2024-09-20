<dialog id="modalJadikanLulus" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white ">
        <div>
            <h3 class="font-bold text-lg">Ubah Status Santri</h3>

            <div class="mt-4">
                <label for="status_input">Status</label>
                <select name="status" id="status_input"
                    class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('status')
                peer
            @enderror">
                    <option value="aktif" selected>Aktif</option>
                    <option value="lulus">Lulus</option>
                    <option value="keluar">Keluar</option>
                    <option value="muhjaz">Muhjaz</option>
                </select>
                @error('status')
                    <p class="peer-invalid:visible text-red-700 font-light">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mt-4 hidden" id="tgl_keluar_area">
                <label for="tgl_keluar">Tanggal Lulus</label>
                <input type="date" name="tgl_keluar" id="tgl_keluar"
                    class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('tgl_keluar')
                peer
            @enderror"
                    placeholder="Masukan Nama Santri" value="{{ old('tgl_keluar') }}">
                @error('tgl_keluar')
                    <p class="peer-invalid:visible text-red-700 font-light">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex gap-2 mt-1">
                <h3>Jumlah data yang dipilih : </h3>
                <span id="jumlahDataYangDipilih"></span>
            </div>
        </div>
        <div class="modal-action">
            <form method="dialog">

                <!-- if there is a button in form, it will close the modal -->
                <button class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Batal</button>
                <label class="btn bg-red-700 text-white border-none hover:bg-red-600"
                    for="btnJadikanLulus">Simpan</label>
            </form>
        </div>
    </div>
</dialog>
@push('scripts')
    <script>
        $(document).ready(function() {
            const jumlahDataTitleArea = $('#jumlahDataYangDipilih');
            const btnAlert = $('#btnModalJadikanLulus');
            const tglLulusInput = $('#tgl_keluar');
            const tglLulusInput1 = $('#tgl_keluar2');
            const status = $('#status_input');
            const statusNilai = $('#status_nilai');
            const tgl_keluar_area = $('#tgl_keluar_area');

            status.on('change', function() {
                statusNilai.val(status.val());
                if (status.val() == 'aktif') {
                    tgl_keluar_area.addClass('hidden');
                } else {
                    tgl_keluar_area.removeClass('hidden');
                }
            });
            btnAlert.on('click', function() {
                const jumlahDataChecked = $('.checkboxValue:checked');
                const nilaiDataChecked = jumlahDataChecked.map(function() {
                    return this.value;
                }).get();
                $('#santri_id_toLulus').val(nilaiDataChecked.join('|'));
                jumlahDataTitleArea.html(jumlahDataChecked.length)
            });
            tglLulusInput.on('change', function() {
                tglLulusInput1.val(tglLulusInput.val());
            });
        });
    </script>
@endpush
