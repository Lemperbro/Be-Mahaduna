<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown{{ $key }}"
    class="text-white bg-Sidebar hover:bg-SidebarActive focus:ring-4 focus:outline-none font-medium rounded-md text-sm px-3 py-1 text-center inline-flex items-center "
    type="button">Aksi <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
    </svg>
</button>

<!-- Dropdown menu -->
<div id="dropdown{{ $key }}" class="z-10 hidden bg-white border rounded-lg shadow-md w-44 ">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
        <li>
            <a href="{{ route('artikel.edit', ['id' => $item->slug]) }}" class=" px-4 py-2 hover:bg-gray-100 w-full text-Sidebar flex gap-2 items-center">
                <i class="ri-edit-2-fill text-xl"></i>
                Edit Artikel
            </a>
        </li>
        <li>
            <button type="button" onclick="delete{{ $key }}.showModal()"
                class=" px-4 py-2 hover:bg-gray-100 w-full text-left text-red-800 flex gap-2 items-center">
                <i class="ri-delete-bin-5-fill text-xl"></i>
                Hapus Artikel
            </button>
        </li>
    </ul>
</div>

@include('admin.artikel._modalDeleteArtikel')
