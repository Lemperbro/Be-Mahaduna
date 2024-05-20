@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="pt-24 min-h-screen">
            <div class="max-w-[1000px] mx-auto pt-20">
                <div class="p-4 rounded-md border-main3 bg-white">
                    <div class="flex gap-4">
                        <img src="{{ asset(auth()->user()->image) }}" alt=""
                            class="object-cover w-20 h-20 rounded-full my-auto">
                        <div>
                            <div class="flex gap-4 items-center mb-2">
                                <h1 class="capitalize font-semibold text-lg">{{ auth()->user()->username }}</h1>
                                <span
                                    class="text-sm text-white bg-lime-600 py-1 px-2 rounded-lg">{{ auth()->user()->role }}</span>
                            </div>
                            <h1 class="text-slate-600">{{ auth()->user()->email }}</h1>
                            <h1 class="text-slate-600">{{ auth()->user()->telp }}</h1>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.update.profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-10">
                        <div>
                            <label for="image">Image Profile</label>
                            <input type="file" name="image" id="image"
                                class="w-full h-15 rounded-md border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 bg-white @error('image')
                                    peer
                                @enderror">
                            @error('image')
                                <p class="peer-invalid:visible text-red-700 font-light">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username"
                                class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 capitalize @error('username')
                                    peer
                                @enderror"
                                value="{{ auth()->user()->username }}">
                            @error('username')
                                <p class="peer-invalid:visible text-red-700 font-light">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"
                                class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 @error('email')
                                    peer
                                @enderror"
                                value="{{ auth()->user()->email }}">
                            @error('email')
                                <p class="peer-invalid:visible text-red-700 font-light">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="telp">Nomor Telphone</label>
                            <input type="number" name="telp" id="telp"
                                class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 @error('telp')
                                    peer
                                @enderror"
                                value="{{ auth()->user()->telp }}">
                            @error('telp')
                                <p class="peer-invalid:visible text-red-700 font-light">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <a href="{{ route('admin.ubah.password') }}" class="bg-Sidebar p-2 rounded-md inline-block text-white text-center">Ubah
                            Password</a>
                    </div>
                    <div class="mt-10">
                        <button class="bg-lime-600 text-white p-2 rounded-md inline-block">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
