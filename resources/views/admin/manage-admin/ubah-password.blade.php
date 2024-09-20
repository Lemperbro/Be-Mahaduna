@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="">
            <div class="max-w-[1000px] mx-auto min-h-screen flex flex-col justify-center">
                <form action="{{ route('admin.ubah.password.save') }}" method="POST">
                    @csrf
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 @error('password')
                                peer
                            @enderror">
                        @error('password')
                            <p class="peer-invalid:visible text-red-700 font-light">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 @error('password')
                            peer
                        @enderror">
                        @error('password')
                            <p class="peer-invalid:visible text-red-700 font-light">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex gap-4 mt-10">
                        <a href="{{ route('admin.profile') }}"
                            class="bg-red-600 p-2 rounded-md text-white inline-block">Batal</a>
                        <button type="submit" class="bg-lime-600 text-white p-2 rounded-md inline-block">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
