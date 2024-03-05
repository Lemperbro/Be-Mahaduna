@use('Carbon\Carbon')
<div class="relative overflow-x-auto shadow-md rounded-md sm:rounded-lg max-w-6xl mx-auto w-full">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-SidebarActive">
            <tr>
                <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-sm w-10">
                    Jam
                </th>
                <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-sm">
                    Katerangan
                </th>
                <th scope="col" class="px-4 md:px-6 py-3 md:py-4 text-sm w-16">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td
                        class="px-2 md:px-6 py-2 md:py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white ">
                        {{ Carbon::parse($item->start_time)->format('H:i') }} -
                        {{ Carbon::parse($item->end_time)->format('H:i') }}
                    </td>
                    <td class="px-2 md:px-6 py-2 md:py-4">
                        {{ $item->jadwal }} 
                    </td>
                    <td class="px-2 md:px-6 py-2 md:py-4 flex gap-2 items-center justify-center h-full">
                        <button type="button" class="bg-red-600 rounded-md justify-center w-8 h-8 flex items-center">
                            <i class="ri-delete-bin-5-fill text-white text-[20px] "></i>
                        </button>
                        <a href="" class="bg-Sidebar rounded-md justify-center w-8 h-8 flex items-center">
                            <i class="ri-edit-2-fill text-white text-[20px]"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
