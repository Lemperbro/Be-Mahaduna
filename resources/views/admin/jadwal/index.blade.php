@extends('admin.layouts.main')
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


@section('container')
    @include('admin.jadwal._modalCreate')
    <section>
        @include('admin.partials._header')
        <div class="pt-24 min-h-screen">
            <button type="button" id="createJadwalBtn" onclick="createJadwal.showModal()"
                class="bg-Sidebar h-16 w-16 hover:w-[214px] flex justify-between items-center overflow-hidden rounded-full transition-all ease-linear duration-200 group fixed z-20 bottom-8 right-8 lg:bottom-10 lg:right-10">
                <div
                    class="text-white w-16 group-hover:w-[214px] absolute h-16 rounded-full justify-start bg-Sidebar -z-10 flex  items-center">
                    <span class="rounded-full  p-4 text-center font-semibold  whitespace-nowrap">
                        Tambah Jadwal
                    </span>
                </div>
                <div
                    class="h-16 w-16 flex bg-Sidebar items-center rounded-full absolute right-0 group-hover:border-2 group-hover:border-SidebarActive">
                    <i
                        class="ri-add-fill text-white text-[30px] w-16 text-center group-hover:rotate-90 transition-all duration-500"></i>
                </div>
            </button>
            <div class="mt-40">
                @include('admin.jadwal._table')
            </div>
        </div>
    </section>
@endsection
