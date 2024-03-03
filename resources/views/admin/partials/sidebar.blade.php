<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-50 w-64 h-screen -translate-x-full bg-Sidebar md:translate-x-0 transition-all duration-500"
    aria-label="Sidebar">
    {{-- logo area --}}
    <div class="h-20 mb-2 border-b-[1px] border-main2 px-3 relative">
        <div class="flex gap-x-4 absolute top-[50%] -translate-y-[50%] p-2">
            <img src="{{ asset('img/logo.png') }}" alt="" class="object-contain w-7 h-7 my-auto">
            <h1 class="font-semibold text-white text-[21px] my-auto">{{ config('services.aplication.AppName') }}</h1>
        </div>
    </div>
    <div class="h-full px-3 pb-[290px] overflow-y-auto bg-Sidebar relative w-64 scrollbar">
        <ul class="space-y-2 font-medium">
            <h1 class="text-gray-400 text-sm">MENU</h1>
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-gray-400 rounded-lg group relative hover:bg-SidebarActive {{ request()->routeIs('dashboard') ? 'bg-SidebarActive' : '' }}">
                    <i class="ri-dashboard-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Dashboard</span>

                </a>
            </li>
            <li>
                <a href="{{ route('playlist.index') }}" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive {{ request()->routeIs('playlist.*') ? 'bg-SidebarActive' : '' }}">
                    <i class="ri-folder-video-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Video Kajian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('artikel.index') }}" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive {{ request()->routeIs('artikel.*') ? 'bg-SidebarActive' : '' }}">
                    <i class="ri-article-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Artikel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('majalah.index') }}" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive {{ request()->routeIs('majalah.*') ? 'bg-SidebarActive' : '' }}">
                    <i class="ri-book-read-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Majalah Addiya</span>
                </a>
            </li>
            <li>
                <a href="{{ route('store.index') }}" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive {{ request()->routeIs('store.*') ? 'bg-SidebarActive' : '' }}">
                    <i class="ri-store-3-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Santri Store</span>
                </a>
            </li>
            <li>
                <a href="{{ route('jadwal.index') }}" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive {{ request()->routeIs('jadwal.*') ? 'bg-SidebarActive' : '' }}">
                    <i class="ri-calendar-schedule-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Jadwal Kegiatan</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive">
                    <i class="ri-bank-card-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Pembayaran SPP</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive">
                    <i class="ri-information-2-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Informasi Ma'had</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive">
                    <i class="ri-gallery-fill text-[20px] transition duration-75 text-gray-400 "></i>
                    <span class="ml-3 font-semibold">Gallery</span>
                </a>
            </li>
            <h1 class="text-gray-400 text-sm">MONITORING</h1>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 512" class="w-5 h-[30px] transition fill-gray-400 duration-75"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M400 0c5 0 9.8 2.4 12.8 6.4c34.7 46.3 78.1 74.9 133.5 111.5l0 0 0 0c5.2 3.4 10.5 7 16 10.6c28.9 19.2 45.7 51.7 45.7 86.1c0 28.6-11.3 54.5-29.8 73.4H221.8c-18.4-19-29.8-44.9-29.8-73.4c0-34.4 16.7-66.9 45.7-86.1c5.4-3.6 10.8-7.1 16-10.6l0 0 0 0C309.1 81.3 352.5 52.7 387.2 6.4c3-4 7.8-6.4 12.8-6.4zM288 512V440c0-13.3-10.7-24-24-24s-24 10.7-24 24v72H192c-17.7 0-32-14.3-32-32V352c0-17.7 14.3-32 32-32H608c17.7 0 32 14.3 32 32V480c0 17.7-14.3 32-32 32H560V440c0-13.3-10.7-24-24-24s-24 10.7-24 24v72H448V454c0-19-8.4-37-23-49.2L400 384l-25 20.8C360.4 417 352 435 352 454v58H288zM70.4 5.2c5.7-4.3 13.5-4.3 19.2 0l16 12C139.8 42.9 160 83.2 160 126v2H0v-2C0 83.2 20.2 42.9 54.4 17.2l16-12zM0 160H160V296.6c-19.1 11.1-32 31.7-32 55.4V480c0 9.6 2.1 18.6 5.8 26.8c-6.6 3.4-14 5.2-21.8 5.2H48c-26.5 0-48-21.5-48-48V176 160z" />
                    </svg>
                    <span class="ml-3 font-semibold">Sholat Jamaah</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive">
                    <i class="ri-book-open-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Ngaji</span>
                </a>
            </li>

            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive">
                    <i class="ri-brain-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Hafalan</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive">
                    <i class="ri-parent-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Wali Santri</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group hover:bg-SidebarActive">
                    <i class="ri-group-fill text-[20px] transition duration-75 text-gray-400"></i>
                    <span class="ml-3 font-semibold">Santri</span>
                </a>
            </li>
        </ul>

        {{-- menu bawa --}}
        <div class="fixed w-64 bottom-0 bg-Sidebar left-0 pt-2 px-3 pb-4">
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center p-2 text-gray-400 rounded-lg group">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="w-5 h-5 fill-gray-400 transition duration-75"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                    </svg>

                    <span class="ml-3 font-semibold">Logout</span>
                </button>

            </form>
            <div class="max-h-[50px] h-full w-full border-t-[1px] border-main2 flex gap-x-3 pt-2">
                <img src="{{ asset('img/myFoto.jpg') }}" alt=""
                    class="object-cover w-10 h-10 rounded-full my-auto">
                <div class="my-auto">
                    <h1 class="text-lg text-white capitalize">{{ auth()->user()->username }}</h1>
                    <h1 class="text-sm text-gray-300 capitalize">{{ auth()->user()->role }}</h1>
                </div>
            </div>
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
