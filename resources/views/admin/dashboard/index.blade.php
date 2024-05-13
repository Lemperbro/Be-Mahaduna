@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')

        {{-- isi --}}
        <div class="pt-24">
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
