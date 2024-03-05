@use('Carbon\Carbon')
<dialog id="updateJadwal{{ $key }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <form action="{{ route('jadwal.update', ['id' => $item->jadwal_id]) }}" method="POST">
            @csrf
            <h3 class="font-bold text-lg">Update Jadwal!</h3>
            <div class="mt-4">
                <label>Jam Mulai</label>
                <div class="relative flex flex-col">
                    <input type="text" name="startTime" id="startTime{{ $key }}" class="hidden">
                    <input type="text" id="startTimeUpdate{{ $key }}"
                        class="w-full py-2 pr-2 pl-8 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1"
                        placeholder="Pilih Jam Mulai" value="{{ Carbon::parse($item->start_time)->format('H:i') }}">
                    <i class="ri-time-line text-[20px] text-gray-500 absolute top-[60%] -translate-y-[60%] left-2"></i>
                </div>
            </div>
            <div class="mt-4">
                <label>Jam Selesai</label>
                <div class="relative flex flex-col">
                    <input type="text" name="endTime" id="endTime{{ $key }}" class="hidden">
                    <input type="text" id="endTimeUpdate{{ $key }}" name="endTime"
                        class="w-full py-2 pr-2 pl-8 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1"
                        placeholder="Pilih Jam Selesai" value="{{ Carbon::parse($item->end_time)->format('H:i') }}">
                    <i class="ri-time-line text-[20px] text-gray-500 absolute top-[60%] -translate-y-[60%] left-2"></i>
                </div>
            </div>
            <div class="mt-4">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan{{ $key }}"
                    class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1"
                    placeholder="Keterangan" value="{{ $item->jadwal }}">
            </div>
            <div class="flex gap-2 mt-4 justify-end">
                <label for="closeModalUpdateJadwal{{ $key }}"
                    class="btn bg-red-700 text-white border-none hover:bg-red-600">Batal</label>
                <button type="submit" class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive"
                    id="btnSimpanUpdateJadwal{{ $key }}">Simpan</button>
            </div>
        </form>
        <div class="modal-action hidden">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn" id="closeModalUpdateJadwal{{ $key }}">Close</button>
            </form>
        </div>
    </div>
</dialog>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).ready(function() {
            const key = @json($key);
            const data = @json($data);
            var timepickerUpdate = {
                enableTime: true,
                static: true,
                noCalendar: true,
                dateFormat: "H:i",
                placeholder: "Pilih Waktu",
                time_24hr: true,
                theme: "light"
            }

            var endTimeUpdate = flatpickr('#endTimeUpdate' + key, timepickerUpdate);
            var startTimeUpdate = flatpickr('#startTimeUpdate' + key, timepickerUpdate);
            var updateBtn = '#updateJadwalBtn' + key;
            $(updateBtn).on('click', function() {
                startTimeUpdate.close();
                endTimeUpdate.close();
            });

            $('#btnSimpanUpdateJadwal' + key).on('click', function() {
                var endVal = $('#endTimeUpdate' + key).val();
                var startVal = $('#startTimeUpdate' + key).val();
                $('#startTime' + key).val(startVal);
                $('#endTime' + key).val(endVal);
            });

        });
    </script>
@endpush
