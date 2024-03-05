@use('Carbon\Carbon')
<dialog id="updateJadwal{{ $key }}" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <form action="{{ route('jadwal.update', ['id' => $item->jadwal_id]) }}" method="POST">
            @csrf
            <h3 class="font-bold text-lg">Update Jadwal!</h3>
            <div class="mt-4">
                <label>Jam Mulai</label>
                <div class="relative flex flex-col mt-1">
                    <input type="time" id="startTimeUpdate{{ $key }}" name="startTime"
                        class="w-full py-2 pr-2 pl-8 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 hidden"
                        placeholder="Pilih Jam Mulai" value="{{ Carbon::parse($item->start_time)->format('H:i') }}">
                    <i class="ri-time-line text-[20px] text-gray-500 absolute top-[60%] -translate-y-[60%] left-2 hidden"></i>
                </div>
            </div>
            <div class="mt-4">
                <label>Jam Selesai</label>
                <div class="relative flex flex-col mt-1">
                    <input type="text" id="endTimeUpdate{{ $key }}" name="endTime"
                        class="w-full py-2 pr-2 pl-8 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 hidden"
                        placeholder="Pilih Jam Selesai" value="{{ Carbon::parse($item->end_time)->format('H:i') }}">
                    <i class="ri-time-line text-[20px] text-gray-500 absolute top-[60%] -translate-y-[60%] left-2 hidden"></i>
                </div>
            </div>
            <div class="mt-4">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan"
                    class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1"
                    placeholder="Keterangan" value="{{ $item->jadwal }}">
            </div>
            <div class="flex gap-2 mt-4 justify-end">
                <label for="closeModalUpdateJadwal{{ $key }}"
                    class="btn bg-red-700 text-white border-none hover:bg-red-600">Batal</label>
                <button type="submit"
                    class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Simpan</button>
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
@push('head')
    <link href="
https://cdn.jsdelivr.net/npm/air-datepicker@3.4.0/air-datepicker.min.css
" rel="stylesheet">
    <style>
        .air-datepicker--time {
            width: 100%;
        }
    </style>
@endpush
@push('scripts')
    <script src="
                https://cdn.jsdelivr.net/npm/air-datepicker@3.4.0/air-datepicker.min.js
                "></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
    <style>
        .air-datepicker {
            width: 100%;
        }
        /* .air-datepicker-time--row input[type="range"]::-webkit-slider-thumb{
            background: black;
        } */
    </style>

    <script>
        $(document).ready(function() {
            const key = @json($key);
            // var timepickerUpdate = {
            //     enableTime: true,
            //     static: true,
            //     noCalendar: true,
            //     dateFormat: "H:i",
            //     placeholder: "Pilih Waktu",
            //     time_24hr: true,
            //     theme: "light"
            // }

            // var endTimeUpdate = flatpickr('#endTimeUpdate' + key, timepickerUpdate);
            // var startTimeUpdate = flatpickr('#startTimeUpdate' + key, timepickerUpdate);
            // var updateBtn = '#updateJadwalBtn' + key;
            // $(updateBtn).on('click', function() {
            //     startTimeUpdate.close();
            //     endTimeUpdate.close();
            // });
            var timepickerUpdate = {
                timepicker: true,
                inline: true,
                dateFormat: 'HH:mm',
                appendTo: '#createJadwal',
                onlyTimepicker: true,
                language: 'id',
                noCalendar: true,
                autoClose: true,

            }
            var endTimeUpdate = new AirDatepicker('#endTimeUpdate' + key, timepickerUpdate);
            var startTimeUpdate = new AirDatepicker('#startTimeUpdate' + key, timepickerUpdate);

        });
    </script>
@endpush
