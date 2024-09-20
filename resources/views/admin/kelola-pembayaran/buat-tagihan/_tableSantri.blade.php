@use('Carbon\Carbon')
<div class="relative  w-full overflow-x-auto">
    <table
        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400  shadow-md rounded-md sm:rounded-md "
        id="tableSantriCreateTagihan">
        <thead class="text-xs text-white capitalize bg-SidebarActive ">
            <tr>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap">
                    <div class="flex gap-2 items-center">
                        <input type="checkbox" class="santriTagihan" id="santriTagihanCheck">
                        <label for="santriTagihanCheck" class="font-normal">Pilih Semua</label>
                    </div>
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Nama Santri
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Jenis Kelamin
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-32">
                    Kelas
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-64 lg:w-96">
                    Tahun Masuk
                </th>
                <th scope="col" class="px-2 py-3 md:py-4 text-sm whitespace-nowrap w-36">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr class="bg-white border-b">
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap">
                        <input type="checkbox" name="santri[]" class="santriTagihanId" id="santriTagihan"
                            value="{{ $item->santri_id }}">
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        <h1>{{ $item->nama }}</h1>
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        {{ $item->jenis_kelamin }}
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        {{ $item->jenjang->jenjang }}
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        {{ Carbon::parse($item->tgl_masuk)->locale('id')->isoFormat(' MMMM YYYY') }}
                    </td>
                    <td class="px-2  py-2 md:py-4 whitespace-nowrap capitalize">
                        {{ $item->status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    <style>
        div.dt-layout-row div.dt-start div.dt-length {
            display: none;
            background: red;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            const santriTagihanValueArea = $('#santriTagihanValueDiv');
            const checkAllBox = $('#santriTagihanCheck');
            const checkValue = $('.santriTagihanId');
            const saveTagihanBtn = $('#saveTagihan');
            // masukan nilai yang di centang ke value input di form atas
            saveTagihanBtn.on('click', function() {
                const value = $('.santriTagihanId:checked').map(function() {
                    return this.value;
                }).get();
                // Kosongkan kontainer sebelum menambahkan input baru
                santriTagihanValueArea.empty();
                value.forEach(element => {
                    var item = document.createElement('input');
                    item.type = 'hidden';
                    item.name =
                        'santri[]'; // Tambahkan atribut name agar sesuai dengan format yang diharapkan di server
                    item.value = element;
                    santriTagihanValueArea.append(item);
                });
            });

            checkAll();

            function checkAll() {
                checkAllBox.on('click', function() {
                    checkValue.prop('checked', checkAllBox.prop('checked'));
                });
            }

            let table = $('#tableSantriCreateTagihan').DataTable({
                responsive: true,
                "bInfo": false,
                ordering: false,
            });


        });
    </script>
@endpush
