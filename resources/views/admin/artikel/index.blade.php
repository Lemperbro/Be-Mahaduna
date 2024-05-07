@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="py-24">
           
            <div class="flex flex-col lg:flex-row gap-4 justify-between">
                <a href="{{ route('artikel.kategori.index') }}"
                    class="bg-Sidebar py-2 px-4 rounded-md text-white inline-block  max-w-[1200px] font-medium order-2 lg:order-1 items-center">
                    <div class="flex gap-2 items-center h-full">

                        <i class="ri-list-settings-fill text-white text-[26px]"></i>
                        Kelola Kategori
                    </div>
                </a>
                @include('admin.artikel._formSearch')
            </div>
            <div class="mt-16">
                <a href="{{ route('artikel.create.index') }}"
                    class="bg-Sidebar h-16 w-16 hover:w-52 flex justify-between items-center overflow-hidden rounded-full transition-all ease-linear duration-200 group fixed z-20 bottom-8 right-8 lg:bottom-10 lg:right-10">
                    <div
                        class="text-white w-16 group-hover:w-52 absolute h-16 rounded-full justify-start bg-Sidebar -z-10 flex  items-center">
                        <span class="rounded-full  p-4 text-center font-semibold  whitespace-nowrap">
                            Tambah Artikel
                        </span>
                    </div>
                    <div
                        class="h-16 w-16 flex bg-Sidebar items-center rounded-full absolute right-0 group-hover:border-2 group-hover:border-SidebarActive">
                        <i class="ri-add-fill text-white text-[30px] w-16 text-center group-hover:rotate-90 transition-all duration-500"></i>
                    </div>
                </a>
            </div>

            <section>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @include('admin.artikel._cardArtikel')
                </div>
                <div class="mt-10">
                    {{ $allArtikel->links('vendor.pagination.tailwind') }}
                </div>
            </section>
        </div>
    </section>
@endsection
