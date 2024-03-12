@extends('admin.layouts.main')

@section('container')
    @use('Carbon\Carbon')
    @use('App\Repositories\TagihanRepository')
    <section>
        @include('admin.partials._header')
        <div class="pt-24 min-h-screen">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="bg-Sidebar rounded-md h-36 p-4">
                    <div class="flex justify-between gap-4 items-center h-full my-auto">
                        <div>
                            <h1 class="text-4xl font-semibold text-white">
                                {{ TagihanRepository::formatAngka($pendapatanTahunIni) }}</h1>
                            <h2 class="text-gray-200">Pemasukan Tahun {{ Carbon::parse(now())->format('Y') }}</h2>
                        </div>
                        <div>
                            <i class="ri-calendar-2-fill text-white text-[56px]"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white border-[1px] border-main3 rounded-md h-36">

                </div>

                <div class="bg-white border-[1px] border-main3 rounded-md h-36">

                </div>

                <div class="bg-white border-[1px] border-main3 rounded-md h-36">

                </div>
            </div>
            <div class="bg-white w-full rounded-md border-[1px] border-main3 p-4 mt-4 flex flex-col sm:flex-row gap-4 items-center">
                <a href="{{ route('kelola-pembayaran.create.tagihan') }}"
                    class="flex gap-2 items-center bg-Sidebar py-1 px-4 rounded-md w-full sm:w-auto justify-center">
                    <i class="ri-add-box-fill text-white text-[20px]"></i>
                    <p class="mt-[2px] text-white whitespace-nowrap">Buat Tagihan</p>
                </a>
                <button class="flex gap-2 items-center justify-center bg-green-600 py-1 px-4 rounded-md w-full sm:w-auto">
                    <i class="ri-download-2-fill text-white text-[20px]"></i>
                    <p class="text-white mt-[2px] whitespace-nowrap">Download Data</p>
                </button>
            </div>
            <div class="bg-white w-full rounded-md border-[1px] border-main3 p-4 mt-4">
                <div class="flex flex-wrap justify-between gap-4">
                    <div class=" items-center">
                        <h1 class="font-semibold text-lg md:text-xl xl:text-2xl">Data Pembayaran</h1>
                        <span class="border-[1px] border-main3 rounded-md py-[2px] px-1 text-sm text-gray-600 bg-main">Total
                            Data {{ $totalData }}</span>
                    </div>
                    <div class="max-w-[1200px] w-[600px]">
                        @include('admin.kelola-pembayaran._search')
                    </div>
                </div>
                <form class="mt-8" action="{{ route('kelola-pembayaran.delete.tagihan.multiple') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <div
                            class="py-2 px-4 text-sm md:text-base inline-block bg-red-600 text-white rounded-md text-center cursor-pointer @error('tagihan_id_delete_multiple')
                                peer
                            @enderror" onclick="deleteTagihanMultiple.showModal()" id="btnAlertDeleteTagihanMultiple">Hapus
                            Tagihan Yang Dipilih</div>
                            <button type="submit" id="btnDeleteTagihanMultiple" class="hidden" ></button>
                        @error('tagihan_id_delete_multiple')
                            <p class="peer-invalid:visible text-red-700 font-light mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="italic text-gray-600 capitalize mt-1 text-xs md:text-sm">*Hanya tagihan yang status
                            pembayarannya (belum dibayar) yang bisa dihapus</p>
                    </div>
                    @include('admin.kelola-pembayaran._table')
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
    @include('admin.kelola-pembayaran._modalDeleteMultiple')
    @foreach ($data as $key => $item)
        @include('admin.kelola-pembayaran._modalKonfirmasiBayar')
        @include('admin.kelola-pembayaran._modalDelete')
    @endforeach
@endsection
