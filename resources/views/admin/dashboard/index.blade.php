@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')

        {{-- isi --}}
        <div class="pt-24">

            @if (session('welcome'))
                <div id="alert-border-3"
                    class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-100 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                    role="alert">
                    <h1 class="text-base md:text-lg xl:text-xl capitalize text-gray-900"><span class="text-3xl">👋</span>
                        Selamat datang
                        <span class="font-semibold">{{ auth()->user()->username }}</span>
                    </h1>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-border-3" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="bg-Sidebar rounded-md h-36 p-4">
                    <div class="flex justify-between gap-4 items-center h-full my-auto">
                        <div>
                            <h1 class="text-4xl font-semibold text-white">
                                100</h1>
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
                                100</h1>
                            <h2 class="text-gray-200">Total Wali Santri</h2>
                        </div>
                        <div>
                            <i class="ri-user-2-fill text-white text-[56px]"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white border-[1px] border-main3 rounded-md h-36">

                </div>

                <div class="bg-white border-[1px] border-main3 rounded-md h-36">

                </div>
            </div>

            <div class="grid gap-4 grid-cols-1 lg:grid-cols-2 mt-4">
                <div class="bg-white border-[1px] border-main3 rounded-md h-[400px]">

                </div>
                <div class="bg-white border-[1px] border-main3 rounded-md h-[400px]">

                </div>
            </div>

            <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-4">
                <div class="bg-white border-[1px] border-main3 rounded-md h-[200px]">

                </div>
                <div class="bg-white border-[1px] border-main3 rounded-md h-[200px]">

                </div>
                <div class="bg-white border-[1px] border-main3 rounded-md h-[200px]">

                </div>
                <div class="bg-white border-[1px] border-main3 rounded-md h-[200px]">

                </div>
                <div class="bg-white border-[1px] border-main3 rounded-md h-[200px]">

                </div>
                <div class="bg-white border-[1px] border-main3 rounded-md h-[200px]">

                </div>
            </div>

            <div class="bg-white border-[1px] border-main3 rounded-md h-[400px] w-full mt-4">

            </div>
        </div>

    </section>
@endsection
