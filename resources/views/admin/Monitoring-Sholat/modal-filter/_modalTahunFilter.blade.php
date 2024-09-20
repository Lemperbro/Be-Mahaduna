@use('Carbon\Carbon')
<dialog id="tahunFilter" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box bg-white">
        <form action="{{ route('monitoring.sholat.index') }}" method="GET">
            <h3 class="font-bold text-lg">Filter Tahun Diupload</h3>
            @if (request('jenjang') !== null)
                <input type="text" name="jenjang" value="{{ request('jenjang') }}" class="hidden">
            @endif
            @if (request('search') !== null)
                <input type="text" name="search" value="{{ request('search') }}" class="hidden">
            @endif
            <div>
                <label for="tahunFilterSelect">Pilih Tahun </label>
                <div class="mt-1">
                    <select name="tahun" id="tahunFilterSelect" class="w-full">
                        @for ($i = 2005; $i <= Carbon::now()->format('Y') + 100; $i++)
                            <option value="{{ $i }}"
                                @if (request('tahun') == null) {{ $i == Carbon::now()->format('Y') ? 'selected' : '' }}
                            @else
                                {{ $i == request('tahun') ? 'selected' : '' }} @endif>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="flex gap-2 mt-4 justify-end">
                <label for="tahunFilterCloseBtn"
                    class="btn bg-red-700 text-white border-none hover:bg-red-600">Batal</label>
                <button type="submit"
                    class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Cari</button>
            </div>
        </form>
        <div class="modal-action hidden">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn" id="tahunFilterCloseBtn">Close</button>
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
        $('#tahunFilterSelect').select2({
            dropdownParent: $('#tahunFilter'),
            width: 'resolve',
            placeholder: "Pilih Tahun",
            language: {
                noResults: function() {
                    return "Tahun Tidak Di Temukan.";
                }
            }
        });
    </script>
@endpush
