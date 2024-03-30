@extends('admin.layouts.main')
@section('container')
    <section>
        @include('admin.partials._header')
        <div class="min-h-screen pt-24">
            <form action="{{ route('wali.update', ['id' => $data->wali_id]) }}" method="POST" class="max-w-[800px] mx-auto mt-10">
                @csrf
                <div class="mt-4">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('nama')
                        peer
                    @enderror"
                        placeholder="Masukan Nama" value="{{ $data->nama }}">
                    @error('nama')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('email')
                        peer
                    @enderror"
                        placeholder="Masukan Email" value="{{ $data->email }}">
                    @error('email')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="30" rows="10"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('alamat')
                        peer
                    @enderror"
                        placeholder="Masukan Alamat">{{ $data->alamat }}</textarea>
                    @error('alamat')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="telp">Telphone</label>
                    <input type="number" name="telp" id="telp"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('telp')
                        peer
                    @enderror"
                        placeholder="Masuk nomor telphone" value="{{ $data->telp }}">
                    @error('telp')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-10 flex gap-4">
                    <a href="{{ route('wali.index') }}"
                        class="px-4 py-2 bg-red-600 rounded-md text-white inline-block">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-Sidebar rounded-md text-white inline-block">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
