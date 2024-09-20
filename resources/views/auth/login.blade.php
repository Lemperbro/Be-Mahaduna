@extends('admin.layouts.auth')


@section('auth')
    <div class="flex flex-col md:flex-row h-screen">
        {{-- image --}}
        <div class="w-full md:w-[40%] h-full  bg-Sidebar py-10 md:py-0 rounded-b-3xl md:rounded-none">
            <div class="mt-auto flex flex-col h-full items-center justify-center">
                <div class="">
                    <img src="{{ asset('img/logo.png') }}" alt="" class="w-32 object-contain mx-auto">
                    <h1 class="font-semibold text-white text-3xl text-center mt-4">Ma'haduNA</h1>
                </div>
                <img src="{{ asset('img/arab1.png') }}" alt=""
                    class="w-[80%] mx-auto object-contain mt-[20%] md:mt-[40%]">
            </div>
        </div>
        {{-- input login --}}
        <form action="{{ route('auth.login.proses') }}" method="POST" class="w-full">
            @csrf
            <div
                class="max-w-[500px] w-full flex flex-col justify-center mx-auto items-center my-20 md:my-auto md:min-h-full md:h-screen px-4 md:px-0">

                <div class="bg-main md:bg-white md:shadow-md px-4 py-8 rounded-lg w-full">
                    <div class="mb-10">
                        <h1 class="font-semibold text-2xl text-center mb-4 text-Sidebar">Hai, Selamat datang
                            <br>
                            Silahkan masuk ke akun kamu
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
                    <div class="relative w-full mt-4">
                        <div class="relative w-full">
                            <label for="password">Password</label>
                            <div class="relative mt-2">
                                <i class="ri-key-fill absolute top-[50%] -translate-y-[50%] left-2 text-[20px]"></i>
                                <input type="password" id="password" name="password" placeholder="••••••••••••"
                                    class="pl-9 w-full rounded-lg border-main3 focus:ring-0 focus:outline-none focus:border-main2 pr-10 @error('password')
                                        perr
                                    @enderror"
                                    required>
                                <i class="ri-eye-fill absolute right-4 text-[20px] top-[50%] -translate-y-[50%]"
                                    id="showPassword"></i>
                            </div>
                            @error('password')
                                <p class="peer-invalid:visible text-red-700 font-light">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full mt-16">
                        <button type="submit"
                            class="w-full rounded-md bg-Sidebar p-4 text-center inline-block text-white cursor-pointer">Masuk</button>
                        <a href="{{ route('auth.lupaPassword') }}" class="text-center inline-block w-full text-Sidebar mt-2">Lupa Password</a>
                        @if ($countSuperAdmin <= 0)
                            <a href="{{ route('auth.adminRegister') }}"
                                class="w-full rounded-md bg-orange-600 p-4 text-center inline-block text-white cursor-pointer mt-2">Register
                                Admin</a>
                        @endif
                    </div>
                </div>


            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#showPassword').on('click', function() {
                let type = $('#password').attr('type') === 'password' ? 'text' : 'password';


                // change icon show password
                type === 'text' ? $(this).removeClass('ri-eye-fill').addClass(
                    'ri-eye-off-fill') : $(this).removeClass('ri-eye-off-fill').addClass(
                    'ri-eye-fill');

                // Mengubah tipe input 
                $('#password').attr('type', type);
            });


        });
    </script>
@endpush
