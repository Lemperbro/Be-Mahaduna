@use('Carbon\Carbon')
<div class="relative overflow-x-auto shadow-md rounded-md sm:rounded-md w-full">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 " id="tableTagihan">
        <thead class="text-xs text-white capitalize bg-SidebarActive ">
            <tr>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm w-10">
                    No
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Nama Santri
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Kelas
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-64 lg:w-96">
                    Keterangan Tagihan
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-36">
                    Tagihan
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-36">
                    Bayar
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-36">
                    Tagihan Bulan
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-40">
                    Jalur Pembayaran
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-44 ">
                    Status Pembayaran
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-16">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1; 
            @endphp
            @foreach ($data as $items)
                @foreach ($items as $key => $item)
                    <tr
                        class="{{ count($items) < 3 ? 'bg-white' : 'bg-red-100 ' }} text-gray-700 border-b  {{ (count($items) - 1) == $key && count($items) >= 2 ? 'border-red-600 border-b-2' : 'border-gray-400' }}">
                        <td class="px-2  py-2 md:py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                            {{ $counter++ }}
                        </td>
                        <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                            <h1>
                                {{ $item->santri->nama }}
                            </h1>
                        </td>
                        <td class="px-2  py-2 md:py-4 capitalize">
                            <h1>
                                {{ $item->santri->jenjang->jenjang }}
                            </h1>
                        </td>
                        <td class="px-2  py-2 md:py-4 capitalize">
                            <h1 class="line-clamp-2">
                                {{ $item->label }}
                            </h1>
                        </td>
                        <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                            Rp. {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                            {{ $item->transaksi !== null ? 'Rp. ' . number_format($item->transaksi->pay, 0, ',', '.') : 'Belum ada' }}
                        </td>
                        <td class="px-2  py-2 md:py-4 capitalize">
                            {{ Carbon::parse($item->date)->locale('id')->isoFormat(' MMMM YYYY') }}
                        </td>
                        <td class="px-2  py-2 md:py-4 capitalize">
                            {{ $item->payment_type ?? 'Belum ada' }}
                        </td>
                        <td class="px-2  py-2 md:py-4 capitalize">
                            @if ($item->status === 'sudah dibayar')
                                <div
                                    class="px-1 py-2 rounded-md bg-green-500 inline-block w-full text-center text-white font-semibold whitespace-nowrap">
                                    Sudah Dibayar
                                </div>
                            @elseif ($item->status === 'menunggu dibayar')
                                <div
                                    class="px-1 py-2 rounded-md bg-yellow-500 inline-block w-full text-center text-white font-semibold whitespace-nowrap">
                                    Menunggu Dibayar
                                </div>
                            @else
                                <div
                                    class="px-1 py-2 rounded-md bg-red-500 inline-block w-full text-center text-white font-semibold whitespace-nowrap">
                                    Belum Dibayar
                                </div>
                            @endif
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
                                        <button type="button" onclick="detail{{ $key }}.showModal()"
                                            class=" px-4 py-2 hover:bg-gray-100 w-full text-Sidebar flex gap-2 items-center">
                                            <i class="ri-eye-fill text-xl"></i>
                                            Lihat Detail
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
