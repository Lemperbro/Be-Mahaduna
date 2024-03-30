@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="min-h-screen pt-24">

            <form action="{{ route('wali.store') }}" method="POST" class="max-w-[800px] mx-auto mt-10">
                @csrf
                <div class="flex p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="">
                        <span class="font-semibold">INFO!</span>
                        <p class="capitalize mt-1">Setiap data wali santri yang dibuat akan memiliki password default <span class="font-semibold">'mahaduna12345'</span>. Mohon informasikan kepada para wali santri untuk segera mengganti password pada halaman profil mereka.</p>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama"
                        class="mt-1 w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('nama')
                            peer
                        @enderror"
                        placeholder="Masukan Nama" value="{{ old('nama') }}">
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
                        placeholder="Masukan Email" value="{{ old('email') }}">
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
                        placeholder="Masukan Alamat">{{ old('alamat') }}</textarea>
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
                        placeholder="Masuk nomor telphone" value="{{ old('telp') }}">
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
