@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="min-h-screen pt-24">
            <div class="mb-4">
                <button type="button" onclick="modalTambahKelas.showModal()"
                    class="flex gap-2 items-center bg-Sidebar py-1 px-4 rounded-md w-full sm:w-auto justify-center">
                    <i class="ri-add-box-fill text-white text-[20px]"></i>
                    <p class="mt-[2px] text-white whitespace-nowrap">Tambah Kelas</p>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($data as $key => $item)
                    <div class="bg-white rounded-md p-4">
                        <h4 class="text-gray-600">Kelas</h4>
                        <h1 class="text-gray-900 font-semibold text-lg capitalize">{{ $item->jenjang }}</h1>
                        <div class="flex gap-2 mt-4">
                            <button type="button" onclick="modalEditKelas{{ $key }}.showModal()" href="" class="bg-lime-600 rounded-md py-[1px] px-1 inline-block">
                                <i class="ri-edit-2-fill text-white"></i>
                            </button>
                            <button type="button" onclick="modalHapusKelas{{ $key }}.showModal()" class="inline-block py-[1px] px-1 bg-red-600 rounded-md">
                                <i class="ri-delete-bin-5-fill text-white"></i>
                            </button>
                        </div>
                    </div>
                    @include('admin.kelas._modalEdit')
                    @include('admin.kelas._modalHapus')
                @endforeach
            </div>
        </div>
    </section>
@endsection
@include('admin.kelas._modalTambah')
