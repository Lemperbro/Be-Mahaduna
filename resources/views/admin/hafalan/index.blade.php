@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="min-h-screen pt-24">
            <div
                class="bg-white w-full rounded-md border-[1px] border-main3 p-4 mt-4 flex flex-col sm:flex-row gap-4 items-center">
                <a href="{{ route('monitoring.hafalan.create') }}"
                    class="flex gap-2 items-center bg-Sidebar py-1 px-4 rounded-md w-full sm:w-auto justify-center">
                    <i class="ri-add-box-fill text-white text-[20px]"></i>
                    <p class="mt-[2px] text-white whitespace-nowrap">Tambah Data</p>
                </a>
                <button class="flex gap-2 items-center justify-center bg-green-600 py-1 px-4 rounded-md w-full sm:w-auto">
                    <i class="ri-download-2-fill text-white text-[20px]"></i>
                    <p class="text-white mt-[2px] whitespace-nowrap">Download Data</p>
                </button>
            </div>

            <div class="bg-white w-full rounded-md border-[1px] border-main3 p-4 mt-4">
                <div class="flex flex-wrap justify-between gap-4">
                    <div class=" items-center">
                        <h1 class="font-semibold text-lg md:text-xl xl:text-2xl">Data Monitoring Hafalan</h1>
                        <span class="border-[1px] border-main3 rounded-md py-[2px] px-1 text-sm text-gray-600 bg-main">Total
                            Show Data {{ $totalShowData }}</span>
                    </div>
                    <div class="max-w-[1200px] w-[600px]">
                        @include('admin.hafalan._search')
                    </div>
                </div>
                <form class="mt-8" action="{{ route('monitoring.hafalan.delete') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <div class="py-2 px-4 text-sm md:text-base inline-block bg-red-600 text-white rounded-md text-center cursor-pointer @error('monitor_mingguan_id_delete_multiple')
                                peer
                            @enderror"
                            onclick="deleteMonitoringMultiple.showModal()" id="btnAlertDeleteMultiple">Hapus
                            Data Yang Dipilih</div>
                        <button type="submit" id="btnDeleteMonitorMultiple" class="hidden"></button>
                        @error('monitor_mingguan_id_delete_multiple')
                            <p class="peer-invalid:visible text-red-700 font-light mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    @include('admin.hafalan._table')
                    @if ($data->count() <= 0)
                        <div class="flex flex-col items-center mx-auto my-14">
                            <img src="{{ asset('icon/no_data2.svg') }}" alt="" class="w-48 h-48 object-contain">
                            <h1 class="text-Sidebar font-semibold mt-2">Tidak Ada Data Yang Ditemukan</h1>
                        </div>
                    @endif
                </form>
            </div>

        </div>
    </section>
    @include('admin.hafalan._modalDelete')
@endsection
