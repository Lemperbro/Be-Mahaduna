@extends('admin.layouts.main')
@section('container')
    {{-- modal include start --}}
    @include('admin.video._modalCreate')
    {{-- modal include end --}}
    <section>
        @include('admin.partials._header')
        <div class="pt-24">

            <div class="flex flex-col lg:flex-row gap-4 justify-between">
                <button type="button" onclick="createPlaylist.showModal()"
                    class="bg-Sidebar py-2 px-4 rounded-md text-white inline-block  max-w-[1200px] font-medium order-2 lg:order-1">
                    <div class="flex gap-2 items-center">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="fill-white w-7 h-7">
                            <path
                                d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11 11H7V13H11V17H13V13H17V11H13V7H11V11Z">
                            </path>
                        </svg>
                        Tambah Playlist
                    </div>
                </button>
                @include('admin.video._formSearch')

            </div>
            <section class="mt-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-6">
                    @include('admin.video._card')
                </div>
                <div class="mt-5">
                    {{ $playlist->links('vendor.pagination.tailwind') }}
                </div>
                @if ($playlist->count() <= 0)
                    <div class="flex flex-col items-center mx-auto mt-32">
                        <img src="{{ asset('icon/no_data2.svg') }}" alt="" class="w-48 h-48 object-contain">
                        <h1 class="text-Sidebar font-semibold mt-2">Tidak Ada Playlist Yang Ditemukan</h1>
                    </div>
                @endif

            </section>
        </div>
    </section>
@endsection
