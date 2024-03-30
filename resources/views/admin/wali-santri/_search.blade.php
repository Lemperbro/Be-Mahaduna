<form class="w-full" action="{{ route('wali.index') }}" method="GET">
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
                    placeholder="Cari Nama, Alamat, Telphone, Email" value="{{ request('keyword') }}" />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-Sidebar hover:bg-SidebarActive focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
            </div>
        </div>
    </div>
</form>

