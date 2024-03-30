<form class="w-full" action="{{ route('santri.index') }}" method="GET">
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
                <input type="text" name="keyword"
                    class="block w-full py-4 pl-10  text-sm text-gray-900 focus:ring-0 focus:outline-none focus:border-none border-none rounded-lg"
                    placeholder="Cari Santri" value="{{ request('keyword') }}" />
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
                    <a href="{{ route('santri.index') }}"
                        class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Clear</a>
                </li>
                <li class="flex justify-between items-center px-4 hover:bg-gray-100">
                    <button type="button" onclick="tahunFilter.showModal()"
                        class="inline-flex w-full py-2 {{ request('tahun') !== null ? 'font-semibold' : '' }}">Tahun</button>
                    @if (request('tahun') !== null)
                        <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                    @endif
                </li>
                <li>
                    <button id="jenjangBtn" data-dropdown-toggle="jenjang" data-dropdown-placement="right-start"
                        type="button"
                        class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 {{ request('jenjang') !== null ? 'font-semibold' : '' }}">
                        Jenjang
                        @if (request('jenjang') !== null)
                            <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                        @endif
                    </button>
                    <div id="jenjang"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-shadow1 w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="jenjangBtn">
                            <li>
                                <h1 class="block px-4 py-2 text-center font-semibold">Pilih Jenjang</h1>
                            </li>
                            @foreach ($jenjang as $item)
                                <li class="flex justify-between items-center hover:bg-gray-100 px-4">
                                    <a href="{{ route('santri.index', array_merge(request()->all(), ['jenjang' => $item->jenjang_id])) }}"
                                        class="block py-2  capitalize">{{ $item->jenjang }}</a>
                                    @if (request('jenjang') !== null && request('jenjang') == $item->jenjang_id)
                                        <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                                    @endif
                                </li>
                            @endforeach

                    </div>
                </li>
                <li>
                    <button id="JenisKelaminBtn" data-dropdown-toggle="JenisKelamin"
                        data-dropdown-placement="right-start" type="button"
                        class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 {{ request('jenis_kelamin') !== null ? 'font-semibold' : '' }}">
                        Jenis Kelamin
                        @if (request('jenis_kelamin') !== null)
                            <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                        @endif
                    </button>
                    <div id="JenisKelamin"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-shadow1 w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="JenisKelaminBtn">
                            <li>
                                <h1 class="block px-4 py-2 text-center font-semibold">Jenis Kelamin</h1>
                            </li>
                            <li class="flex justify-between items-center hover:bg-gray-100 px-4">
                                <a href="{{ route('santri.index', array_merge(request()->all(), ['jenis_kelamin' => 'laki-laki'])) }}"
                                    class="block py-2  ">laki-laki</a>
                                @if (request('jenis_kelamin') !== null && request('jenis_kelamin') == 'laki-laki')
                                    <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                                @endif
                            </li>
                            <li class="flex justify-between items-center hover:bg-gray-100 px-4">
                                <a href="{{ route('santri.index', array_merge(request()->all(), ['jenis_kelamin' => 'perempuan'])) }}"
                                    class="block py-2 hover:bg-gray-100 ">Perempuan</a>
                                @if (request('jenis_kelamin') !== null && request('jenis_kelamin') == 'perempuan')
                                    <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                                @endif
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="statusButton" data-dropdown-toggle="status" data-dropdown-placement="right-start"
                        type="button"
                        class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 {{ request('status') !== null ? 'font-semibold' : '' }}">
                        Status
                        @if (request('status') !== null)
                            <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                        @endif
                    </button>
                    <div id="status"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-shadow1 w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="statusButton">
                            <li>
                                <h1 class="block px-4 py-2 text-center font-semibold">Pilih status</h1>
                            </li>
                            <li class="flex justify-between items-center hover:bg-gray-100 px-4">
                                <a href="{{ route('santri.index', array_merge(request()->all(), ['status' => 'aktif'])) }}"
                                    class="block py-2  ">Aktif</a>
                                @if (request('status') !== null && request('status') == 'aktif')
                                    <i class="ri-checkbox-circle-fill text-lime-500 text-[15px]"></i>
                                @endif
                            </li>
                            <li class="flex justify-between items-center hover:bg-gray-100 px-4">
                                <a href="{{ route('santri.index', array_merge(request()->all(), ['status' => 'lulus'])) }}"
                                    class="block py-2  ">Lulus</a>
                                @if (request('status') !== null && request('status') == 'lulus')
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

@include('admin.santri.modal-filter._modalTahunFilter')
