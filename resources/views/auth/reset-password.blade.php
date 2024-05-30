@extends('admin.layouts.auth')


@section('auth')
    <div class="h-screen flex flex-col ">
        <form action="{{ route('auth.saveResetPassword') }}" method="POST" class="w-full">
            @csrf
            <div
                class="max-w-[500px] w-full flex flex-col justify-center mx-auto items-center my-20 md:my-auto md:min-h-full md:h-screen px-4 md:px-0">

                <div class="bg-main md:bg-white md:shadow-md px-4 py-8 rounded-lg w-full">
                    <div class="mb-10">
                        <h1 class="font-semibold text-2xl text-center mb-4 text-Sidebar">Ubah Password
                        </h1>
                    </div>
                    <input type="hidden" name="token" value="{{ request()->token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
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
                    <div class="relative w-full mt-4">
                        <div class="relative w-full">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <div class="relative mt-2">
                                <i class="ri-key-fill absolute top-[50%] -translate-y-[50%] left-2 text-[20px]"></i>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="••••••••••••"
                                    class="pl-9 w-full rounded-lg border-main3 focus:ring-0 focus:outline-none focus:border-main2 pr-10 @error('password')
                                        perr
                                    @enderror"
                                    required>
                                <i class="ri-eye-fill absolute right-4 text-[20px] top-[50%] -translate-y-[50%]"
                                    id="showPasswordConfirmation"></i>
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
                            class="w-full rounded-md bg-Sidebar p-4 text-center inline-block text-white cursor-pointer">Simpan
                            Password</button>
                        <a href="{{ route('auth.login') }}"
                            class="text-center inline-block w-full text-Sidebar mt-2">Login</a>
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

            $('#showPasswordConfirmation').on('click', function() {
                let type = $('#password_confirmation').attr('type') === 'password' ? 'text' : 'password';
                // change icon show password
                type === 'text' ? $(this).removeClass('ri-eye-fill').addClass(
                    'ri-eye-off-fill') : $(this).removeClass('ri-eye-off-fill').addClass(
                    'ri-eye-fill');
                $('#password_confirmation').attr('type', type);

            });

        });
    </script>
@endpush
