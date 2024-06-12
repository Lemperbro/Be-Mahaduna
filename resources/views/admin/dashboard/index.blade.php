@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')

        {{-- isi --}}
        <div class="pt-24">
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                <div class="grid grid-cols-1 gap-4 ">
                    <div
                        class="bg-white border-[1px] border-main3 rounded-md p-4 min-h-36 xl:h-36  relative overflow-hidden flex flex-col md:flex-row lg:flex-col xl:flex-row gap-2">
                        <div class="">
                            <h1 class="capitalize text-Sidebar2 text-xl font-medium">{{ $greeting }},
                                {{ auth()->user()->username }}! Terus semangat dan tetap produktif!</h1>
                            <a href="{{ route('kelola-pembayaran.index') }}"
                                class="inline-block px-2 py-1 mt-5 rounded-md border-Sidebar2 border ">Lihat Data Tagihan</a>
                        </div>
                        <div class="xl:w-80  min-h-36 relative  w-full">
                            <div class="absolute top-2 right-0 ">
                                <img src="{{ asset('icon/hello.png') }}" alt="" class="w-80">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-Sidebar rounded-md h-36 p-4">
                        <div class="flex justify-between gap-4 items-center h-full my-auto">
                            <div>
                                <h1 class="text-4xl font-semibold text-white">
                                    {{ $countSantri }}</h1>
                                <h2 class="text-gray-200">Total Santri</h2>
                            </div>
                            <div>
                                <i class="ri-parent-fill text-white text-[56px]"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-Sidebar rounded-md h-36 p-4">
                        <div class="flex justify-between gap-4 items-center h-full my-auto">
                            <div>
                                <h1 class="text-4xl font-semibold text-white">
                                    {{ $countWali }}</h1>
                                <h2 class="text-gray-200">Total Wali Santri</h2>
                            </div>
                            <div>
                                <i class="ri-user-2-fill text-white text-[56px]"></i>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="grid gap-4 grid-cols-1 lg:grid-cols-2 mt-4">
                <div class="bg-white border-[1px] border-main3 rounded-md h-[500px]">

                </div>
                <div class="bg-white border-[1px] border-main3 rounded-md h-[500px]">

                </div>
            </div>


        </div>

    </section>
@endsection
