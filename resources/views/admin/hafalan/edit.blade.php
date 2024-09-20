@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="pt-24 min-h-screen flex flex-col max-w-[1000px] mx-auto justify-center">
            <form action="{{ route('monitoring.hafalan.update', ['id' => $data->monitor_bulanan_id]) }}" method="POST" class="w-full mx-auto">
                @csrf
                <div>
                    <label for="santri">Santri</label>
                    <input type="text"
                    class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 bg-gray-200 text-gray-700"
                    value="{{ $data->santri->nama }}" readonly>
                </div>
                <div class="mt-4">
                    <label for="progres">Progres</label>
                    <input type="text" id="progres" name="progres"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('progres')
                            peer
                        @enderror" value="{{ $data->progres }}"
                        placeholder="masukan progres">
                    @error('progres')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="date">Bulan Monitoring</label>
                    <div class="mt-1 @error('bulan')
                        peer
                    @enderror">
                        <input type="date" name="bulan" id="bulan"
                            class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2" value="{{ $data->bulan }}"
                            placeholder="pilih bulan monitoring">
                    </div>
                    @error('bulan')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex gap-4 mt-10">
                    <a href="{{ route('monitoring.hafalan') }}" class="bg-red-600 p-2 rounded-md text-white">Batal</a>
                    <button type="submit" class="bg-Sidebar text-white p-2 rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .select2-selection.select2-selection--single {
            min-height: 45px;
            padding-top: 7px;
            padding-left: 7px;
        }

        span.select2-selection__rendered {
            margin-top: 2px;
        }

        span.select2-selection__arrow {
            margin-top: 9px;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            $('#santriSelect').select2({
                width: 'resolve',
                placeholder: "Pilih Santri",
                language: {
                    noResults: function() {
                        return "Santri Tidak Di Temukan.";
                    }
                }
            });
            var datepicker = {
                dateFormat: "Y-m",
                allowInput: true,
                placeholder: "Pilih Bulan Monitoring",
                theme: "light",
            };

            flatpickr('#bulan', datepicker)
        });
    </script>
@endpush
