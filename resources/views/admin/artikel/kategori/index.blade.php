@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="py-24">
            {{-- <div class="flex gap-4 justify-end">
                @include('admin.artikel.kategori._formSearchKategori')
            </div> --}}
            <div class="mt-16">
                <button type="button" onclick="addKategori.showModal()"
                    class="bg-Sidebar h-16 w-16 hover:w-56 flex justify-between items-center overflow-hidden rounded-full transition-all ease-linear duration-200 group fixed z-20 bottom-8 right-8 lg:bottom-10 lg:right-10">
                    <div
                        class="text-white w-16 group-hover:w-56 absolute h-16 rounded-full justify-start bg-Sidebar -z-10 flex  items-center">
                        <span class="rounded-full  p-4 text-center font-semibold  whitespace-nowrap">
                            Tambah Kategori
                        </span>
                    </div>
                    <div
                        class="h-16 w-16 flex bg-Sidebar items-center rounded-full absolute right-0 group-hover:border-2 group-hover:border-SidebarActive">
                        <i
                            class="ri-add-fill text-white text-[30px] w-16 text-center group-hover:rotate-90 transition-all duration-500"></i>
                    </div>
                </button>
                @include('admin.artikel.kategori._modalAddKategoriArtikel')
            </div>

            <section>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @include('admin.artikel.kategori._card')
                </div>
                <div class="mt-10">
                    {{ $allKategori->links('vendor.pagination.tailwind') }}
                </div>
            </section>
        </div>
    </section>
@endsection
@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection.select2-selection--multiple {
            min-height: 50px;
            padding-top: 7px;
            padding-left: 7px;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
