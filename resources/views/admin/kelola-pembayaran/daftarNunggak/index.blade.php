@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="min-h-screen pt-24">
            <div
                class="bg-white w-full rounded-md border-[1px] border-main3 p-4 mt-4 flex flex-col sm:flex-row gap-4 items-center">
                <a  href="{{ route('kelola-pembayaran.tunggakan', http_build_query(array_merge(request()->all(), ['download' => true]))) }}" class="flex gap-2 items-center justify-center bg-green-600 py-1 px-4 rounded-md w-full sm:w-auto">
                    <i class="ri-download-2-fill text-white text-[20px]"></i>
                    <p class="text-white mt-[2px] whitespace-nowrap">Download Data</p>
                </a>
            </div>

            <div class="bg-white w-full rounded-md border-[1px] border-main3 p-4 mt-4">
                <div class="flex flex-wrap justify-between gap-4">
                    <div class=" items-center">
                        <h1 class="font-semibold text-lg md:text-xl xl:text-2xl">Daftar Tunggakan</h1>
                        <span class="border-[1px] border-main3 rounded-md py-[2px] px-1 text-sm text-gray-600 bg-main">Total
                            Show Data {{ $showTotal }}</span>
                    </div>
                    <div class="max-w-[1200px] w-[600px]">
                        @include('admin.kelola-pembayaran.daftarNunggak._search')
                    </div>
                </div>
                <div class="mt-8">
                    @csrf
                    @include('admin.kelola-pembayaran.daftarNunggak._table')
                    @if ($data->count() <= 0)
                        <div class="flex flex-col items-center mx-auto my-14">
                            <img src="{{ asset('icon/no_data2.svg') }}" alt="" class="w-48 h-48 object-contain">
                            <h1 class="text-Sidebar font-semibold mt-2">Tidak Ada Data Yang Ditemukan</h1>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>
@endsection
