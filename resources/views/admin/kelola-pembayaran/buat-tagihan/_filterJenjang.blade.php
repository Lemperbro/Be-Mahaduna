<div>
    <label for="jenjangFilterSelect">Kelas</label>
    <div class="mt-1">
        <select name="jenjang" id="jenjangFilterSelect"
            class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2">
            <option value="" selected>Pilih Kelas</option>
            @foreach ($dataJenjang as $key => $item)
                <option value="{{ $item->jenjang_id }}" {{ $item->jenjang_id == request('jenjang') ? 'selected' : '' }}>
                    {{ ucwords($item->jenjang) }}
                </option>
            @endforeach
        </select>
    </div>
</div>
@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection {
            min-height: 41px;
            padding-top: 7px;
            padding-left: 7px;
        }

        .select2-selection__arrow {
            margin-top: 7px;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#jenjangFilterSelect').select2({
            width: 'resolve',
            placeholder: "Pilih kelas",
            language: {
                noResults: function() {
                    return "Kelas Tidak Di Temukan.";
                }
            }
        });
    </script>
@endpush
