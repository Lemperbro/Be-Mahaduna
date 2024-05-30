@extends('admin.layouts.auth')


@section('auth')
    <div class="h-screen flex flex-col ">
        <form action="{{ route('auth.createLinkReset') }}" method="POST" class="w-full">
            @csrf
            <div
                class="max-w-[500px] w-full flex flex-col justify-center mx-auto items-center my-20 md:my-auto md:min-h-full md:h-screen px-4 md:px-0">

                <div class="bg-main md:bg-white md:shadow-md px-4 py-8 rounded-lg w-full">
                    <div class="mb-10">
                        <h1 class="font-semibold text-2xl text-center mb-4 text-Sidebar">Masukan Email
                        </h1>
                    </div>
                    <div class="relative w-full">
                        <label for="">Email</label>
                        <div class="relative mt-2">
                            <i class="ri-mail-fill absolute top-[50%] -translate-y-[50%] left-2 text-[20px]"></i>
                            <input type="text" id="email" name="email" placeholder="Email"
                                class="pl-9 w-full rounded-lg border-main3 focus:ring-0 focus:outline-none focus:border-main2 @error('email')
                            perr
                        @enderror"
                                required>
                        </div>
                        @error('email')
                            <p class="peer-invalid:visible text-red-700 font-light">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="w-full mt-16">
                        <button type="submit"
                            class="w-full rounded-md bg-Sidebar p-4 text-center inline-block text-white cursor-pointer">Kirim Link Reset</button>
                        <a href="{{ route('auth.login') }}" class="text-center inline-block w-full text-Sidebar mt-2">Kembali</a>
                    </div>
                </div>


            </div>
        </form>
    </div>
@endsection
