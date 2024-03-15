@extends('admin.layouts.main')
@section('container')
    <section>
        @include('admin.partials._header')
        <div class="pt-24 min-h-screen">
            <form action="{{ route('kelola-pembayaran.store.tagihan') }}" method="POST" class="max-w-[1000px] mx-auto">
                @csrf
                <div>
                    <label for="label">Keterangan Tagihan</label>
                    <div class="mt-1">
                        @error('label')
                            <p class="peer-invalid:visible text-red-700 font-light">
                                {{ $message }}
                            </p>
                        @enderror
                        <textarea name="label" id="label" cols="30" rows="10"
                            class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 h-20 @error('label')
                                peer
                            @enderror"
                            placeholder="Masukan keterangan tagihan">
                    </textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="price">Tagihan</label>
                    <div class="mt-1">
                        @error('price')
                            <p class="peer-invalid:visible text-red-700 font-light">
                                {{ $message }}
                            </p>
                        @enderror
                        <input type="number" name="price" id="price"
                            class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('price')
                            peer
                        @enderror"
                            placeholder="Masukan jumlah tagihan">
                    </div>
                </div>
                <div class="mt-4">
                    <label for="date">Bulan Tagihan</label>
                    <div class="mt-1">
                        @error('date')
                            <p class="peer-invalid:visible text-red-700 font-light">
                                {{ $message }}
                            </p>
                        @enderror
                        <input type="date" name="date" id="date"
                            class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2"
                            placeholder="pilih bulan dan tahun untuk tagihan">
                    </div>
                </div>
                <div class="hidden" id="santriTagihanValueDiv">
                </div>
                <div class="flex gap-2">
                    <button type="submit" id="submitBtnFormTagihan" class="hidden">Simpan</button>
                </div>
            </form>
            <div class="mt-4 max-w-[1000px] mx-auto">
                <label for="santri">Pilih Santri</label>
                @error('santri')
                    <p class="peer-invalid:visible text-red-700 font-light mt-1">
                        {{ $message }}
                    </p>
                @enderror
                <div
                    class="mt-1 bg-white p-3 rounded-md border  border-main3 focus:ring-0 focus:outline-none focus:border-main2">
                    <form action="{{ route('kelola-pembayaran.create.tagihan') }}" method="GET" class="pb-4">
                        <h1 class="font-semibold">Filter Data</h1>
                        <div class="grid gap-2 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 mt-4">
                            @include('admin.kelola-pembayaran.buat-tagihan._filterTahun')
                            @include('admin.kelola-pembayaran.buat-tagihan._filterJenisKelamin')
                            @include('admin.kelola-pembayaran.buat-tagihan._filterJenjang')
                        </div>
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('kelola-pembayaran.create.tagihan') }}"
                                class="bg-red-600 text-white p-2 rounded-md">Reset Filter</a>
                            <button type="submit" class="bg-Sidebar text-white p-2 rounded-md">Pakai Filter</button>
                        </div>
                    </form>
                    @include('admin.kelola-pembayaran.buat-tagihan._tableSantri')
                </div>
                <div class="mt-8 flex gap-2">
                    <a href="{{ route('kelola-pembayaran.index') }}" class="bg-red-600 p-2 rounded-md text-white">Batal</a>
                    <label for="submitBtnFormTagihan" class="bg-Sidebar text-white p-2 rounded-md"
                        id="saveTagihan">Simpan</label>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).ready(function() {
            var datepicker = {
                dateFormat: "Y-m",
                allowInput: true,
                placeholder: "Pilih Bulan dan tahun",
                theme: "light",
            };

            flatpickr('#date', datepicker)
        });
    </script>
@endpush
