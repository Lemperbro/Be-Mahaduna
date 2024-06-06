<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-50 w-80 h-screen -translate-x-full bg-Sidebar lg:translate-x-0 transition-all duration-500"
    aria-label="Sidebar">
    {{-- logo area --}}
    <div class="h-20 mb-2 border-b-[1px] border-main2 px-3 relative">
        <div class=" absolute top-[50%] -translate-y-[50%] p-2 w-full">
            <div class="flex gap-x-4 justify-between w-full pr-[25px]">
                <div class="flex gap-x-4">
                    <img src="{{ asset('img/logo.png') }}" alt="" class="object-contain w-7 h-7 my-auto">
                    <h1 class="font-semibold text-white text-[21px] my-auto">{{ config('services.aplication.AppName') }}
                    </h1>
                </div>

                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex justify-center w-8 h-8 items-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 bg-white">
                    <i class="ri-close-fill text-[30px]"></i>
                </button>
            </div>

        </div>
    </div>
    <div class="h-full px-3 pb-[290px] overflow-y-auto bg-Sidebar relative w-80 scrollbar-sidebar">
        <ul class="space-y-2 font-medium">
            <h1 class="text-gray-400 text-sm">MENU</h1>
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group relative hover:bg-SidebarActive hover:text-white {{ request()->routeIs('dashboard') ? 'bg-SidebarActive text-white' : '' }}">
                    <i class="ri-dashboard-fill text-[20px] transition duration-75 "></i>
                    <span class="ml-3 font-semibold">Dashboard</span>

                </a>
            </li>
            <li>
                <a href="{{ route('playlist.index') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white justify-between {{ request()->routeIs('playlist.*') ? 'bg-SidebarActive text-white active' : '' }}">
                    <div class="flex items-center">
                        <i class="ri-folder-video-fill text-[20px] transition duration-75"></i>
                        <span class="ml-3 font-semibold">Video Kajian</span>
                    </div>
                    <span
                        class="px-[3px] min-w-5 h-5 bg-main2 text-white group-[.active]:bg-Sidebar rounded-[4px] border-[1px] border-main3/60 text-[11px] text-center justify-center flex items-center">{{ $kajianCount > 90 ? '90+' : $kajianCount }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('artikel.index') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white justify-between {{ request()->routeIs('artikel.*') ? 'bg-SidebarActive text-white active' : '' }}">
                    <div class="flex items-center">
                        <i class="ri-article-fill text-[20px] transition duration-75"></i>
                        <span class="ml-3 font-semibold">Artikel</span>
                    </div>
                    <span
                        class="px-[3px] min-w-5 h-5 bg-main2 text-white group-[.active]:bg-Sidebar rounded-[4px] border-[1px] border-main3/60 text-[11px] text-center justify-center flex items-center">{{ $artikelCount > 90 ? '90+' : $artikelCount }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('majalah.index') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white justify-between {{ request()->routeIs('majalah.*') ? 'bg-SidebarActive text-white active' : '' }}">
                    <div class="flex items-center">
                        <i class="ri-book-read-fill text-[20px] transition duration-75"></i>
                        <span class="ml-3 font-semibold">Majalah Addiya</span>
                    </div>
                    <span
                        class="px-[3px] min-w-5 h-5 bg-main2 text-white group-[.active]:bg-Sidebar rounded-[4px] border-[1px] border-main3/60 text-[11px] text-center justify-center flex items-center">{{ $majalahCount > 90 ? '90+' : $majalahCount }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('store.index') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white justify-between {{ request()->routeIs('store.*') ? 'bg-SidebarActive text-white active' : '' }}">
                    <div class="flex items-center">
                        <i class="ri-store-3-fill text-[20px] transition duration-75"></i>
                        <span class="ml-3 font-semibold">Santri Store</span>
                    </div>
                    <span
                        class="px-[3px] min-w-5 h-5 bg-main2 text-white group-[.active]:bg-Sidebar rounded-[4px] border-[1px] border-main3/60 text-[11px] text-center justify-center flex items-center">{{ $storeCount > 90 ? '90+' : $storeCount }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('jadwal.index') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white {{ request()->routeIs('jadwal.*') ? 'bg-SidebarActive' : '' }}">
                    <i class="ri-calendar-schedule-fill text-[20px] transition duration-75"></i>
                    <span class="ml-3 font-semibold">Jadwal Kegiatan</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-400 transition-all duration-75 rounded-lg group dropdownSidebar {{ request()->routeIs('kelola-pembayaran.*') ? 'bg-SidebarActive text-white' : '' }}"
                    aria-controls="tagihan" data-collapse-toggle="tagihan">
                    <i class="ri-bank-card-fill text-[20px] transition duration-75"></i>
                    <span class="flex-1 font-semibold ml-3 text-left whitespace-nowrap">Tagihan</span>
                    <svg class="w-3 h-3 arrowSidebar transition-all duration-300" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="tagihan" class="hidden py-2 space-y-2 duration-300 transition-all">
                    <li>
                        <a href="{{ route('kelola-pembayaran.index') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group {{ request()->routeIs('kelola-pembayaran.*') && !request()->routeIs('kelola-pembayaran.tunggakan') ? 'text-white font-semibold' : '' }}">Semua
                            Data Tagihan</a>
                    </li>
                    <li>
                        <a href="{{ route('kelola-pembayaran.tunggakan') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group {{ request()->routeIs('kelola-pembayaran.tunggakan') ? 'text-white font-semibold' : '' }}">Data
                            Tunggakan</a>
                    </li>
                </ul>
            </li>
            {{-- <li>
                <a href="{{ route('kelola-pembayaran.index') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white {{ request()->routeIs('kelola-pembayaran.*') ? 'bg-SidebarActive text-white' : '' }}">
                    <i class="ri-bank-card-fill text-[20px] transition duration-75"></i>
                    <span class="ml-3 font-semibold">Pembayaran SPP</span>
                </a>
            </li> --}}
            <li>
                <a href="/admin"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white">
                    <i class="ri-information-2-fill text-[20px] transition duration-75"></i>
                    <span class="ml-3 font-semibold">Informasi Ma'had</span>
                </a>
            </li>
            <li>
                <a href="/admin"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white">
                    <i class="ri-gallery-fill text-[20px] transition duration-75 "></i>
                    <span class="ml-3 font-semibold">Gallery</span>
                </a>
            </li>
            <h1 class="text-gray-400 text-sm">MONITORING</h1>
            <li>
                <a href="{{ route('monitoring.sholat.index') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white {{ request()->routeIs('monitoring.sholat.*') || request()->is('monitoring/sholat/*') ? 'bg-SidebarActive text-white' : '' }}">
                    <i class="ri-school-fill text-[20px] transition duration-75"></i>
                    <span class="ml-3 font-semibold mt-1">Sholat Jamaah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('monitoring.ngaji.index') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white {{ request()->routeIs('monitoring.ngaji.*') || request()->is('monitoring/ngaji/*') ? 'bg-SidebarActive text-white' : '' }}">
                    <i class="ri-book-open-fill text-[20px] transition duration-75"></i>
                    <span class="ml-3 font-semibold">Ngaji</span>
                </a>
            </li>

            <li>
                <a href="{{ route('monitoring.hafalan') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white {{ request()->routeIs('monitoring.hafalan') || request()->routeIs('monitoring.hafalan.*') ? 'bg-SidebarActive text-white' : '' }}">
                    <i class="ri-brain-fill text-[20px] transition duration-75"></i>
                    <span class="ml-3 font-semibold">Hafalan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('wali.index') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white {{ request()->routeIs('wali.*') ? 'bg-SidebarActive text-white' : '' }}">
                    <i class="ri-parent-fill text-[20px] transition duration-75"></i>
                    <span class="ml-3 font-semibold">Wali Santri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('santri.index') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive hover:text-white {{ request()->routeIs('santri.*') ? 'bg-SidebarActive text-white' : '' }}">
                    <i class="ri-group-fill text-[20px] transition duration-75"></i>
                    <span class="ml-3 font-semibold">Santri</span>
                </a>
            </li>
        </ul>

        {{-- menu bawa --}}
        <div class="fixed w-[313px] bottom-0 bg-Sidebar left-0 pt-2 px-3 pb-4">
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center p-2 text-gray-400 rounded-lg group w-full">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-5 h-5 fill-gray-400 transition duration-75"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                    </svg>

                    <span class="ml-3 font-semibold">Logout</span>
                </button>

            </form>
            <a href="{{ route('admin.profile') }}"
                class=" max-h-[65px] p-4 h-full w-full border-t-[1px] border-main2 flex gap-x-3 pt-2 {{ request()->routeIs('admin.*') ? 'bg-SidebarActive' : '' }}">
                <img src="{{ asset(auth()->user()->image) }}" alt=""
                    class="object-cover w-10 h-10 rounded-full my-auto">
                <div class="my-auto">
                    <h1 class="text-lg text-white capitalize">{{ auth()->user()->username }}</h1>
                    <h1 class="text-sm text-gray-300 capitalize">{{ auth()->user()->role }}</h1>
                </div>
            </a>
        </div>
    </div>
</aside>



@push('scripts')
    <script>
        var dropdownSidebar = document.querySelectorAll('.dropdownSidebar');
        var arrowSidebar = document.querySelectorAll('.arrowSidebar');

        dropdownSidebar.forEach(function(element, index) {
            element.addEventListener('click', function() {
                arrowSidebar[index].classList.toggle('rotate-180');
            });
        });
    </script>
@endpush
