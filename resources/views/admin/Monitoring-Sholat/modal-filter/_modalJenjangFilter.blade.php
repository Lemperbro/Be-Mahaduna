@use('Carbon\Carbon')
<dialog id="jenjangFilter" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <form action="{{ route('monitoring.sholat.index') }}" method="GET">
            <h3 class="font-bold text-lg">Filter Kelas</h3>
            @if (request('tahun') !== null)
                <input type="text" name="tahun" value="{{ request('tahun') }}" class="hidden">
            @endif
            @if (request('search') !== null)
                <input type="text" name="search" value="{{ request('search') }}" class="hidden">
            @endif
            <div>
                <label for="jenjangFilterSelect">Pilih Kelas</label>
                <div class="mt-1">
                    <select name="jenjang" id="jenjangFilterSelect" class="w-full">
                        @foreach ($dataJenjang as $key => $item)
                            <option value="{{ $item->jenjang_id }}"
                                @if (request('jenjang') == null) {{ $item->jenjang_id == request('jenjang') ? 'selected' : '' }}
                                @else
                                    {{ $item->jenjang_id == request('jenjang') ? 'selected' : '' }} @endif>
                                {{ ucwords($item->jenjang) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex gap-2 mt-4 justify-end">
                <label for="jenjangFilterCloseBtn"
                    class="btn bg-red-700 text-white border-none hover:bg-red-600">Batal</label>
                <button type="submit"
                    class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Cari</button>
            </div>
        </form>
        <div class="modal-action hidden">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn" id="jenjangFilterCloseBtn">Close</button>
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
        $('#jenjangFilterSelect').select2({
            dropdownParent: $('#jenjangFilter'),
            width: 'resolve',
            placeholder: "Pilih Jenjang",
            language: {
                noResults: function() {
                    return "Kelas Tidak Di Temukan.";
                }
            }
        });
    </script>
@endpush
