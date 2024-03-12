@use('Carbon\Carbon')

<div>
    <label for="tahunFilterSelect">Tahun</label>
    <div class="mt-1">
        <select name="tahun" id="tahunFilterSelect" class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2">
            <option value="" selected>Pilih Tahun</option>
            @for ($i = 2005; $i <= Carbon::now()->format('Y') + 100; $i++)
                <option value="{{ $i }}" {{ $i == request('tahun') ? 'selected' : '' }} >
                    {{ $i }}
                </option>
            @endfor
        </select>
    </div>
</div>
@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection{
            min-height: 41px;
            padding-top: 7px;
            padding-left: 7px;
        }
        .select2-selection__arrow{
            margin-top: 7px;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#tahunFilterSelect').select2({
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
