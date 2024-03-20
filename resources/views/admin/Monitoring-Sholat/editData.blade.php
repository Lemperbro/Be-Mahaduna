@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="pt-24 min-h-screen flex flex-col max-w-[1000px] mx-auto justify-center">
            <form
                action="{{ $type === 'sholat' ? route('monitoring.update', ['type' => 'sholat', 'id' => $data->monitor_mingguan_id]) : route('monitoring.update', ['type' => 'ngaji', 'id' => $data->monitor_mingguan_id]) }}"
                method="POST" class="w-full mx-auto">
                @csrf
                <div>
                    <label>Santri</label>
                    <div class="mt-1">
                        <input type="text"
                            class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 bg-gray-200 text-gray-700"
                            value="{{ $data->santri->nama }}" readonly>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="hadir">Jumlah Hadir</label>
                    <input type="number" id="hadir" name="hadir"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('hadir')
                            peer
                        @enderror"
                        placeholder="masukan jumlah hadir" value="{{ $data->hadir }}">
                    @error('hadir')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="tidak_hadir">Tidak Hadir</label>
                    <input type="number" id="tidak_hadir" name="tidak_hadir"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('tidak_hadir')
                            peer
                        @enderror"
                        placeholder="masukan jumlah Tidak hadir" value="{{ $data->tidak_hadir }}">
                    @error('tidak_hadir')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="terlambat">Terlambat Hadir</label>
                    <input type="number" id="terlambat" name="terlambat"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('terlambat')
                            peer
                        @enderror"
                        placeholder="masukan jumlah Terlambat Hadir" value="{{ $data->terlambat }}">
                    @error('terlambat')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
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
