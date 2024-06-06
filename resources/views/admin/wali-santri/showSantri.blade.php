@extends('admin.layouts.main')
@use('Carbon\Carbon')
@section('container')
    <section>
        @include('admin.partials._header')
        <div class="min-h-screen pt-24">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($data->waliRelasi as $item)
                    <div class="border border-main3 rounded-md bg-white relative pb-10">
                        <div class="p-2">
                            <h1 class="font-semibold text-lg">{{ $item->santri->nama }}</h1>
                            <div class="text-gray-600 capitalize">
                                <div class="mt-2">
                                    <h3>Kelas</h3>
                                    <h3 class="font-semibold">{{ $item->santri->jenjang->jenjang }}</h3>
                                </div>
                                <div class="mt-2">
                                    <h3>Jenis Kelamin</h3>
                                    <h3 class="font-semibold">{{ $item->santri->jenis_kelamin }}</h3>
                                </div>
                                <div class="mt-2">
                                    <h3>Tanggal Lahir</h3>
                                    <h3 class="font-semibold">
                                        {{ Carbon::parse($item->santri->tgl_lahir)->locale('id')->isoFormat('DD MMMM YYYY') }}
                                    </h3>
                                </div>

                                @if (in_array($item->santri->status, ['lulus', 'keluar']))
                                <div class="mt-2">
                                    <h3>Tanggal Keluar</h3>
                                    <h3 class="font-semibold">
                                        {{ Carbon::parse($item->santri->tgl_keluar)->locale('id')->isoFormat('DD MMMM YYYY') }}
                                    </h3>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        @if ($item->santri->status === 'aktif')
                            <div
                                class="w-full rounded-b-md bg-lime-500 p-1 text-center text-white mt-4 capitalize font-semibold absolute bottom-0 ">
                                {{ $item->santri->status }}
                            </div>
                        @else
                            <div
                                class="w-full rounded-b-md bg-Sidebar p-1 text-center text-white mt-4 capitalize font-semibold absolute bottom-0 ">
                                {{ $item->santri->status }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            @if ($data->waliRelasi->count() <= 0)
                <div class="flex flex-col items-center mx-auto my-14">
                    <img src="{{ asset('icon/no_data2.svg') }}" alt="" class="w-48 h-48 object-contain">
                    <h1 class="text-Sidebar font-semibold mt-2">Tidak Ada Data Yang Ditemukan</h1>
                </div>
            @endif
        </div>
    </section>
@endsection
