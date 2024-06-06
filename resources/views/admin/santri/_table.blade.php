@use('Carbon\Carbon')
<div class="relative overflow-x-auto shadow-md rounded-md sm:rounded-md w-full">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 " id="tableTagihan">
        <thead class="text-xs text-white capitalize bg-SidebarActive ">
            <tr>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm w-10 text-center">
                    <input type="checkbox" id="checkboxAll">
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm w-10 text-center">
                    No
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Nama Santri
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32 ">
                    Wali
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Kelas
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-40">
                    Tanggal Lahir
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-40">
                    Tanggal Keluar
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Jenis Kelamin
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Status
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-16 text-center">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr class="{{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-200 ' }} text-gray-700 border-b ">
                    <td class="px-2  py-2 md:py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                        <input type="checkbox" name="santri_id[]" value="{{ $item->santri_id }}" class="checkboxValue">
                    </td>
                    <td class="px-2  py-2 md:py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->nama }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->waliRelasi !== null ? $item->waliRelasi->wali->nama : 'Tidak Ada' }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->jenjang->jenjang }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->tgl_lahir }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        @if (in_array($item->status, ['lulus', 'keluar']))
                            <h1>
                                {{ $item->tgl_keluar }}
                            </h1>
                        @else
                            <h1>
                                Tidak Ada
                            </h1>
                        @endif
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>
                            {{ $item->jenis_kelamin }}
                        </h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize flex gap-x-1.5 items-center">
                        @if ($item->status == 'aktif')
                        <span class="bg-lime-600 w-2.5 h-2.5 rounded-full"></span>
                        @elseif (in_array($item->status, ['lulus', 'muhjaz']))
                        <span class="bg-Sidebar w-2.5 h-2.5 rounded-full"></span>
                        @elseif ($item->status == 'keluar')
                        <span class="bg-red-600 w-2.5 h-2.5 rounded-full"></span>
                        @endif
                        <h1>
                            {{ $item->status }}
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
                                    <a href="{{ route('santri.edit', ['id' => $item->santri_id]) }}"
                                        class=" px-4 py-2 hover:bg-gray-100 w-full text-Sidebar flex gap-2 items-center">
                                        <i class="ri-edit-2-fill text-xl"></i>
                                        Edit
                                    </a>
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
