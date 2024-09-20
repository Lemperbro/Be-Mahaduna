@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="pt-24 min-h-screen">
            <a href="{{ route('store.create') }}"
                class="bg-Sidebar h-16 w-16 hover:w-[214px] flex justify-between items-center overflow-hidden rounded-full transition-all ease-linear duration-200 group fixed z-20 bottom-8 right-8 lg:bottom-10 lg:right-10">
                <div
                    class="text-white w-16 group-hover:w-[214px] absolute h-16 rounded-full justify-start bg-Sidebar -z-10 flex  items-center">
                    <span class="rounded-full  p-4 text-center font-semibold  whitespace-nowrap">
                        Tambah Produk
                    </span>
                </div>
                <div
                    class="h-16 w-16 flex bg-Sidebar items-center rounded-full absolute right-0 group-hover:border-2 group-hover:border-SidebarActive">
                    <i
                        class="ri-add-fill text-white text-[30px] w-16 text-center group-hover:rotate-90 transition-all duration-500"></i>
                </div>
            </a>
            <section>
                <h1 class="mb-4 text-lg">Produk</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @include('admin.store._card')
                </div>
                <div class="mt-10">
                    {{ $data->links('vendor.pagination.tailwind') }}
                </div>
                @if ($data->count() <= 0)
                    <div class="flex flex-col items-center mx-auto mt-32">
                        <img src="{{ asset('icon/no_data2.svg') }}" alt="" class="w-48 h-48 object-contain">
                        <h1 class="text-Sidebar font-semibold mt-2">Tidak Ada Produk Yang Ditemukan</h1>
                    </div>
                @endif
            </section>
        </div>
    </section>
@endsection
