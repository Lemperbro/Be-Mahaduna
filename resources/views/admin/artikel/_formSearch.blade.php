<form class="max-w-[600px] w-full order-1 lg:order-2" action="{{ route('playlist.index') }}" method="GET">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white ">Search</label>
    <div class="relative w-full">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="search" id="default-search" name="search"
            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-Sidebar focus:border-SidebarActive"
            placeholder="Cari Artikel...." value="{{ request('search') }}"/>
        <button type="submit"
            class="text-white absolute end-2.5 bottom-2.5 bg-Sidebar hover:bg-SidebarActive focus:ring-4 focus:outline-none focus:ring-SidebarActive font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
    </div>
</form>
