@use('Carbon\Carbon')
<div class="relative overflow-x-auto shadow-md rounded-md sm:rounded-md w-full">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 " id="tableTagihan">
        <thead class="text-xs text-white capitalize bg-SidebarActive ">
            <tr>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm w-10">
                    <input type="checkbox" id="checkboxAll">
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm w-10">
                    No
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Nama Santri
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Jenjang
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-64 lg:w-96">
                    Tahun Masuk
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-36">
                    Hadir
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-36">
                    Tidak Hadir
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-36">
                    Terlambat
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-40">
                    Kategori Monitoring
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-44 ">
                    Di Upload
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-16">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr class="{{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-200 ' }} text-gray-700 border-b ">
                    <td class="px-2  py-2 md:py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                        <input type="checkbox" name="monitor_mingguan_id_delete_multiple[]"
                            value="{{ $item->monitor_mingguan_id }}" class="checkboxValue">
                    </td>

                    <td class="px-2  py-2 md:py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->santri->nama }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->santri->jenjang->jenjang }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ Carbon::parse($item->santri->tgl_masuk)->locale('id')->isoFormat(' MMMM YYYY') }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->hadir }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->tidak_hadir }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->terlambat }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->kategori }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ Carbon::parse($item->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}
                        </h1>
                    </td>
                    <td class="px-2 py-2 md:py-4">
                        <div class="mx-auto flex items-center">
                            <i class="ri-more-2-fill cursor-pointer mx-auto" id="actionMenuBtn{{ $key }}"
                                data-dropdown-toggle="actionMenuContent{{ $key }}"></i>
                        </div>
                        <div id="actionMenuContent{{ $key }}"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-shadow1 w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="actionMenuBtn{{ $key }}">
                                    <li>
                                        <a href=""
                                            class=" px-4 py-2 hover:bg-gray-100 w-full text-Sidebar flex gap-2 items-center">
                                            <i class="ri-edit-2-fill text-xl"></i>
                                            Edit
                                        </a>
                                    </li>
                                    <li>
                                        <button type="button" onclick=""
                                            class=" px-4 py-2 hover:bg-gray-100 w-full text-left text-red-800 flex gap-2 items-center">
                                            <i class="ri-delete-bin-5-fill text-xl"></i>
                                            Hapus
                                        </button>
                                    </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {

            const checkAllBtn = $('#checkboxAll');
            const checkValue = $('.checkboxValue');
            checkAll();

            function checkAll() {
                checkAllBtn.on('click', function() {
                    checkValue.prop('checked', checkAllBtn.prop('checked'));
                });
            }
        });
    </script>
@endpush
