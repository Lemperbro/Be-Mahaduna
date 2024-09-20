@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="min-h-screen pt-24">
            <form action="{{ route('santri.store') }}" method="POST" class="max-w-[800px] mx-auto mt-10">
                @csrf
                <div>
                    <label for="nama">Nama Santri</label>
                    <input type="text" name="nama" id="nama"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('nama')
                    peer
                @enderror"
                        placeholder="Masukan Nama Santri" value="{{ old('nama') }}">
                    @error('nama')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('tgl_lahir')
                    peer
                @enderror"
                        placeholder="Masukan Nama Santri" value="{{ old('tgl_lahir') }}">
                    @error('tgl_lahir')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('jenis_kelamin')
                    peer @enderror">
                        <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki
                        </option>
                        <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                    @error('jenis_kelamin')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="jenjang">Kelas</label>
                    <select name="jenjang" id="jenjang"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('jenjang')
                    peer @enderror">
                        @foreach ($jenjang as $item)
                            <option value="{{ $item->jenjang_id }}" class="capitalize"
                                {{ old('jenjang') == $item->jenjang_id ? 'selected' : '' }}>{{ ucwords($item->jenjang) }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenjang')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="waliSelect">Wali Santri</label>
                    <div class="mt-1">
                        <select name="wali" id="waliSelect"
                            class="w-full @error('wali')
                            peer
                        @enderror">
                            @foreach ($wali as $item)
                                <option value="{{ $item->wali_id }}" class="flex justify-between">
                                    {{ ucwords($item->nama) }} ({{ ucwords($item->desa) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('wali')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-10 flex gap-4">
                    <a href="{{ route('santri.index') }}"
                        class="px-4 py-2 bg-red-600 rounded-md text-white inline-block">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-Sidebar rounded-md text-white inline-block">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#waliSelect').select2({
                width: 'resolve',
                placeholder: "Pilih Wali",
                language: {
                    noResults: function() {
                        return "Wali Tidak Di Temukan.";
                    }
                }
            });
            var datepicker = {
                dateFormat: "Y-m-d",
                allowInput: true,
                placeholder: "Pilih Tanggal Lahir",
                theme: "light",
            };
            flatpickr('#tgl_lahir', datepicker);
        });
    </script>
@endpush
