@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="pt-24 min-h-screen flex flex-col max-w-[1000px] mx-auto justify-center">
            <form action="{{ $type === 'sholat' ? route('monitoring.store', ['type' => 'sholat']) : route('monitoring.store', ['type' => 'ngaji']) }} " method="POST"
                class="w-full mx-auto">
                @csrf
                <div>
                    <label for="santri">Pilih Santri</label>
                    <div class="mt-1">
                        <select name="santri" id="santriSelect" class="w-full">
                            <option value="" selected>Pilih Santri</option>
                            @foreach ($santri as $key => $item)
                                <option value="{{ $item->santri_id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="hadir">Jumlah Hadir</label>
                    <input type="number" id="hadir" name="hadir"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2"
                        placeholder="masukan jumlah hadir">
                </div>
                <div class="mt-4">
                    <label for="tidak_hadir">Tidak Hadir</label>
                    <input type="number" id="tidak_hadir" name="tidak_hadir"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2"
                        placeholder="masukan jumlah Tidak hadir">
                </div>
                <div class="mt-4">
                    <label for="terlambat">Terlambat Hadir</label>
                    <input type="number" id="terlambat" name="terlambat"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2"
                        placeholder="masukan jumlah Terlambat Hadir">
                </div>
                <div class="flex gap-4 mt-10">
                    <a href="{{ $type === 'sholat' ? route('monitoring.sholat.index') : route('monitoring.ngaji.index') }}"
                        class="bg-red-600 p-2 rounded-md text-white">Batal</a>
                    <button type="submit" class="bg-Sidebar text-white p-2 rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <script>
        $('#santriSelect').select2({
            width: 'resolve',
            placeholder: "Pilih Santri",
            language: {
                noResults: function() {
                    return "Santri Tidak Di Temukan.";
                }
            }
        });
    </script>
@endpush
