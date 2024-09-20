

<!-- Dropdown menu -->
<div class="z-50 hidden max-w-lg w-full h-[620px] my-4 text-base overflow-hidden list-none bg-white rounded shadow-lg relative"
id="notification-dropdown">
<div class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50">
    Notifications
</div>
<div class="overflow-y-auto scrollbar h-[620px]">
    @for ($i = 1; $i <= 20; $i++)
        <form action="" method="POST">
            @csrf
            <button class="w-full text-left flex px-4 py-3 bg-main border-b-[1px] border-main4">
                <div class="w-full pl-3">
                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                        Norifikasi Baru
                        <div class="text-xs font-medium text-primary-700 dark:text-primary-400">
                            21 September 2023
                        </div>
                    </div>
            </button>
        </form>
    @endfor

</div>
<div
    class="fixed bottom-0 w-full block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50">
    <form action="" method="POST" id="read_all_admin">
        @csrf
        <button type="submit" class="capitalize">mark as read all</button>
    </form>
</div>
</div>
<!-- Dropdown menu -->