<form class="w-full" action="{{ route('kelola-pembayaran.index') }}" method="GET">
    @if (request('status') !== null)
        <input type="text" name="status" value="{{ request('status') }}" class="hidden">
    @endif
    @if (request('bulan') !== null)
        <input type="text" name="bulan" value="{{ request('bulan') }}" class="hidden">
    @endif
    @if (request('tahun') !== null)
        <input type="text" name="tahun" value="{{ request('tahun') }}" class="hidden">
    @endif
    <div class="flex border border-main3 rounded-lg focus:ring-0 focus:outline-none focus:border-main2 bg-white">
        <div class="relative w-full">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="tagihanSearch" name="search"
                    class="block w-full py-4 pl-10  text-sm text-gray-900 focus:ring-0 focus:outline-none focus:border-none border-none rounded-lg"
                    placeholder="Cari Disini...." value="{{ request('search') }}" />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-Sidebar hover:bg-SidebarActive focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
            </div>
        </div>

        <button id="dropdown-button" data-dropdown-toggle="filter"
            class="flex gap-2 items-center justify-between px-4 border-l-2 relative" type="button">
            <i class="ri-filter-3-fill text-[25px]"></i>
            <span class="hidden md:block">Filters </span>
            @if (request('tahun') || request('bulan') || request('status'))
                <i class="ri-checkbox-circle-fill text-lime-500 text-[15px] absolute left-[34px] top-5"></i>
            @endif
        </button>
        <div id="filter" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-shadow1 w-44">
            <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdown-button">
                <li>
                    <a href="{{ route('kelola-pembayaran.index') }}"
                        class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Clear</a>
                </li>
                <li class="flex justify-between items-center px-4 hover:bg-gray-100">
                    <button type="button" onclick="bulanFilter.showModal()"
                        class="inline-flex w-full py-2 {{ request('bulan') !== null ? 'font-semibold' : '' }}">Bulan</button>
                    @if (request('bulan') !== null)
                        <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                    @endif
                </li>
                <li class="flex justify-between items-center px-4 hover:bg-gray-100">
                    <button type="button" onclick="tahunFilter.showModal()"
                        class="inline-flex w-full py-2 {{ request('tahun') !== null ? 'font-semibold' : '' }}">Tahun</button>
                    @if (request('tahun') !== null)
                        <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                    @endif
                </li>
                <li>
                    <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                        data-dropdown-placement="right-start" type="button"
                        class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 {{ request('status') !== null ? 'font-semibold' : '' }}">
                        Status
                        @if (request('status') !== null)
                            <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                        @endif
                    </button>
                    <div id="doubleDropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-shadow1 w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="doubleDropdownButton">
                            <li>
                                <h1 class="block px-4 py-2 text-center font-semibold">Pilih status</h1>
                            </li>
                            <li class="flex justify-between items-center hover:bg-gray-100 px-4">
                                <a href="{{ route('kelola-pembayaran.index', array_merge(request()->all(), ['status' => 'sudah'])) }}"
                                    class="block py-2  ">Sudah
                                    Dibayar</a>
                                @if (request('status') !== null && request('status') == 'sudah')
                                    <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                                @endif
                            </li>
                            <li class="flex justify-between items-center hover:bg-gray-100 px-4">
                                <a href="{{ route('kelola-pembayaran.index', array_merge(request()->all(), ['status' => 'belum'])) }}"
                                    class="block py-2 hover:bg-gray-100 ">Belum
                                    Dibayar</a>
                                @if (request('status') !== null && request('status') == 'belum')
                                    <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                                @endif
                            </li>
                            <li class="flex justify-between items-center hover:bg-gray-100 px-4">
                                <a href="{{ route('kelola-pembayaran.index', array_merge(request()->all(), ['status' => 'menunggu'])) }}"
                                    class="block py-2 hover:bg-gray-100 ">Menunggu
                                    Dibayar</a>
                                @if (request('status') !== null && request('status') == 'menunggu')
                                    <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                                @endif
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</form>
@include('admin.kelola-pembayaran.modal-Filter._modalTahunFilter')
@include('admin.kelola-pembayaran.modal-Filter._modalBulanFilter')
