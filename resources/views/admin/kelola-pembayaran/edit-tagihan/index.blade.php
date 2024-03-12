@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="pt-24 min-h-screen">
            <form action="{{ route('kelola-pembayaran.update', ['id' => $data->tagihan_id]) }}" method="POST"
                class="max-w-[1000px] mx-auto mt-20">
                @csrf
                <div>
                    <label for="santri">Nama Santri</label>
                    <p class="my-2 italic text-gray-500">(Tidak bisa diubah)</p>
                    <input type="text" value="{{ $data->santri->nama }}"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2"
                        readonly>
                </div>
                <div class="mt-4">
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
                            {{ $data->label }}
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
                            placeholder="Masukan jumlah tagihan" value="{{ $data->price }}">
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
                            placeholder="pilih bulan dan tahun untuk tagihan" value="{{ $data->date }}">
                    </div>
                </div>
                <div class="flex gap-2 mt-10">
                    <a href="{{ route('kelola-pembayaran.index') }}" class="bg-red-600 p-2 rounded-md text-white">Batal</a>
                    <button type="submit" id="submitBtnFormTagihan"
                        class="bg-Sidebar text-white p-2 rounded-md">Simpan</button>
                </div>
            </form>
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
