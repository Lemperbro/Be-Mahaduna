<dialog id="modalUbahKelas" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white ">
        <div>
            <h3 class="font-bold text-lg">Ubah Kelas</h3>
            <p class="mt-4">Kamu akan mengubah kelas santri yang dipilih menjadi</p>
            <div class="mt-4">
                <label for="kelas">Pilih Kelas</label>
                <select name="kelas" id="kelas" class="w-full">
                    @foreach ($jenjang as $item)
                        <option value="{{ $item->jenjang_id }}">{{ ucwords($item->jenjang) }}</option>
                    @endforeach
                </select>
                @error('kelas')
                    <p class="peer-invalid:visible text-red-700 font-light">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex gap-2 mt-1">
                <h3>Jumlah data yang dipilih : </h3>
                <span id="jumlahDataYangDipilih2"></span>
            </div>
        </div>
        <div class="modal-action">
            <form method="dialog">

                <!-- if there is a button in form, it will close the modal -->
                <button class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Batal</button>
                <label class="btn bg-red-700 text-white border-none hover:bg-red-600" for="btnUbahKelas">Simpan</label>
            </form>
        </div>
    </div>
</dialog>
@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection.select2-selection--multiple {
            min-height: 50px;
            padding-top: 7px;
            padding-left: 7px;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            const jumlahDataTitleArea = $('#jumlahDataYangDipilih2');
            const btnAlert = $('#btnModalUbahKelas');
            const kelasInput = $('#kelas');
            const kelasInput1 = $('#kelas_id');

            $('#kelas').select2({
                dropdownParent: $('#modalUbahKelas'),
                width: 'resolve',
                placeholder: "Pilih Kelas",
                language: {
                    noResults: function() {
                        return "Kelas Tidak Di Temukan.";
                    }
                }
            });

            btnAlert.on('click', function() {
                const jumlahDataChecked = $('.checkboxValue:checked');
                const nilaiDataChecked = jumlahDataChecked.map(function() {
                    return this.value;
                }).get();
                jumlahDataTitleArea.html(jumlahDataChecked.length);
                $('#santri_id_ubah_kelas').val(nilaiDataChecked.join('|'));
            });
            kelasInput.on('change', function() {
                kelasInput1.val(kelasInput.val());
            });



        });
    </script>
@endpush
