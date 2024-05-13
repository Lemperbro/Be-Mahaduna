@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="min-h-screen pt-24">
            <div
                class="bg-white w-full rounded-md border-[1px] border-main3 p-4 mt-4 flex flex-col sm:flex-row gap-4 items-center">
                <a href="{{ route('santri.create') }}"
                    class="flex gap-2 items-center bg-Sidebar py-1 px-4 rounded-md w-full sm:w-auto justify-center">
                    <i class="ri-add-box-fill text-white text-[20px]"></i>
                    <p class="mt-[2px] text-white whitespace-nowrap">Tambah Data</p>
                </a>
                <a href="{{ route('kelas.index') }}"
                    class="flex gap-2 items-center bg-Sidebar py-1 px-4 rounded-md w-full sm:w-auto justify-center">
                    <i class="ri-bar-chart-fill text-white text-[20px]"></i>
                    <p class="mt-[2px] text-white whitespace-nowrap">Kelola Kelas</p>
                </a>
                <button class="flex gap-2 items-center justify-center bg-green-600 py-1 px-4 rounded-md w-full sm:w-auto">
                    <i class="ri-download-2-fill text-white text-[20px]"></i>
                    <p class="text-white mt-[2px] whitespace-nowrap">Download Data</p>
                </button>

            </div>

            <div class="bg-white w-full rounded-md border-[1px] border-main3 p-4 mt-4">
                <div class="flex flex-wrap justify-between gap-4">
                    <div class=" items-center">
                        <h1 class="font-semibold text-lg md:text-xl xl:text-2xl">Data Santri</h1>
                        <span class="border-[1px] border-main3 rounded-md py-[2px] px-1 text-sm text-gray-600 bg-main">Total
                            Show Data {{ $dataTotal }}</span>
                    </div>
                    <div class="max-w-[1200px] w-[600px]">
                        @include('admin.santri._search')
                    </div>
                </div>
                {{-- form ubah kelas --}}
                <form action="{{ route('santri.ubah-kelas') }}" method="POST" class="hidden">
                    @csrf
                    <input type="text" name="kelas" class="hidden" id="kelas_id">
                    <input type="text" name="santri_id" class="hidden" id="santri_id_ubah_kelas">
                    <button type="submit" id="btnUbahKelas" class="hidden"></button>
                </form>
                {{-- form jadikan Lulus --}}
                <form action="{{ route('santri.toLulus') }}" method="POST" class="hidden">
                    <input type="date" name="tgl_keluar" class="hidden" id="tgl_keluar2">
                    <input type="text" name="santri_id" class="hidden" id="santri_id_toLulus">
                    @csrf
                    <button type="submit" id="btnJadikanLulus" class="hidden"></button>
                </form>
                <form class="mt-8" action="{{ route('santri.delete') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <p class="italic text-gray-500 mb-2 text-sm">Note: Pilih Santri Terlebih Dahulu Sebelum Menggunakan
                            Aksi</p>
                        <div class="flex flex-wrap gap-4">
                            <button type="button"
                                class="py-2 px-4 text-sm md:text-base w-full sm:w-auto inline-block bg-red-600 text-white rounded-md text-center cursor-pointer @error('santri_id')
                            peer
                            @enderror"
                                onclick="deleteMultiple.showModal()" id="btnAlertDeleteMultiple">
                                Hapus Data Yang Dipilih
                            </button>
                            {{-- belum fungsi start --}}
                            <button type="button" onclick="modalJadikanLulus.showModal()" id="btnModalJadikanLulus"
                                class="flex gap-2 items-center bg-Sidebar py-1 px-4 rounded-md w-full sm:w-auto justify-center">
                                <i class="ri-graduation-cap-fill text-white text-[20px]"></i>
                                <p class="mt-[2px] text-white whitespace-nowrap text-sm md:text-base">Jadikan Lulus</p>
                            </button>
                            <button type="button" onclick="modalUbahKelas.showModal()" id="btnModalUbahKelas"
                                class="flex gap-2 items-center bg-Sidebar py-1 px-4 rounded-md w-full sm:w-auto justify-center">
                                <i class="ri-edit-2-fill text-white text-[20px]"></i>
                                <p class="mt-[2px] text-white whitespace-nowrap text-sm md:text-base">Ubah Kelas</p>
                            </button>
                            {{-- belum fungsi end --}}
                        </div>
                        <button type="submit" id="btnDeleteMultiple" class="hidden"></button>
                        @error('santri_id')
                            <p class="peer-invalid:visible text-red-700 font-light mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    @include('admin.santri._table')
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
    @include('admin.santri._modalDelete')
    @include('admin.santri._modalJadikanLulus')
    @include('admin.santri._modalUbahKelas')
@endsection
