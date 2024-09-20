<dialog id="createJadwal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <form id="jadwalForm" action="{{ route('jadwal.store') }}" method="POST">
            @csrf
            <h3 class="font-bold text-lg">Tambah Data Jadwal!</h3>
            <div class="mt-4">
                <label>Jam Mulai</label>
                <div class="relative flex flex-col">
                    <input type="text" id="startTime" name="startTime"
                        class="w-full py-2 pr-2 pl-8 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1"
                        placeholder="Pilih Jam Mulai">
                    <i class="ri-time-line text-[20px] text-gray-500 absolute top-[60%] -translate-y-[60%] left-2"></i>
                </div>
            </div>
            <div class="mt-4">
                <label>Jam Selesai</label>
                <div class="relative flex flex-col">
                    <input type="text" id="endTime" name="endTime"
                        class="w-full py-2 pr-2 pl-8 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1"
                        placeholder="Pilih Jam Selesai">
                    <i class="ri-time-line text-[20px] text-gray-500 absolute top-[60%] -translate-y-[60%] left-2"></i>
                </div>
            </div>
            <div class="mt-4">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan"
                    class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1"
                    placeholder="Keterangan">
            </div>
            <div class="flex gap-2 mt-4 justify-end">
                <button type="button" id="closeModalCreateJadwal"
                    class="btn bg-red-700 text-white border-none hover:bg-red-600">Batal</button>
                <button type="submit"
                    class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Simpan</button>
            </div>
        </form>
    </div>
</dialog>

@push('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            var timepicker = {
                enableTime: true,
                static: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                theme: "light",
                onChange: function(selectedDates, dateStr, instance) {
                    instance.input.setCustomValidity('');
                }
            }

            var startTime = flatpickr('#startTime', timepicker);
            var endTime = flatpickr('#endTime', timepicker);

            $('#startTime').on('blur change', function() {
                validateTimeInput(this);
            });

            $('#endTime').on('blur change', function() {
                validateTimeInput(this);
            });

            function validateTimeInput(input) {
                var regex = /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/;
                if (!regex.test(input.value)) {
                    input.setCustomValidity('Format waktu tidak valid. Gunakan format HH:mm.');
                } else {
                    input.setCustomValidity('');
                }
                input.reportValidity();
            }

            $('#createJadwalBtn').on('click', function() {
                startTime.close();
                endTime.close();
            });

            $('#closeModalCreateJadwal').on('click', function() {
                const dialog = document.getElementById('createJadwal');
                dialog.close();
            });

            $('#jadwalForm').on('submit', function(e) {
                var startTimeInput = $('#startTime')[0];
                var endTimeInput = $('#endTime')[0];

                validateTimeInput(startTimeInput);
                validateTimeInput(endTimeInput);

                if (!startTimeInput.checkValidity() || !endTimeInput.checkValidity()) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
