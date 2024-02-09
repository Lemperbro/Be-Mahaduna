<div class="fixed w-full top-0 left-0 px-4 border-b-[1px] border-main3 bg-main">
    <div class="h-20 relative md:ml-64">
        <div class="absolute top-[50%] -translate-y-[50%] w-full overflow-hidden">
            <div class="flex flex-row  justify-between">
                <div class="flex gap-x-2">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <h1 class="font-semibold text-Sidebar my-auto text-xl">Dashboard</h1>
                </div>

                <div class="flex gap-x-2 sm:mx-0">
                    <form action="" class="hidden sm:block">
                        <div class="relative">
                            <input type="text"
                                class="rounded-md bg-white pl-10 py-2 h-9 border-main3 focus:ring-0 focus:border-main2"
                                placeholder="Search">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="w-5 h-5 fill-gray-500 absolute left-3 top-[50%] -translate-y-[50%]"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                        </div>
                    </form>

                    <div class="h-9 bg-white relative w-9 border-main3 border rounded-md sm:hidden" id="btn-search">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                            class="w-5 h-5 absolute top-[50%] -translate-y-[50%] left-[50%] -translate-x-[50%]"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                        </svg>
                    </div>
                    {{-- notifikasi icon --}}
                    <div class="h-9 bg-white relative w-9 border-main3 border rounded-md"
                        data-dropdown-toggle="notification-dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                            class="w-5 h-5 absolute top-[50%] -translate-y-[50%] left-[50%] -translate-x-[50%]"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z" />
                        </svg>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- search mobile --}}
<form action="" id="search" class="hidden sm:hidden">
    <div class="relative">
        <input type="text" class="rounded-md bg-white pl-10 py-2 h-9 border-main3 focus:ring-0 focus:border-main2" placeholder="Search">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            class="w-5 h-5 fill-gray-500 absolute left-3 top-[50%] -translate-y-[50%]"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path
                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
        </svg>
    </div>
</form>

{{-- notifikasi page --}}
@include('admin.partials.norifikasi')

@push('scripts')
    <script>
        var search = document.getElementById('search');
        var btnSearch = document.getElementById('btn-search');

        btnSearch.addEventListener('click', function() {
            search.classList.add('fixed');
            search.classList.add('top-24');
            search.classList.add('right-5');
            if (search.classList.contains('fixed')) {
                search.classList.toggle('hidden');
            }
        });
    </script>
@endpush
