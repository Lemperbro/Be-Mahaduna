<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen -translate-x-full bg-Sidebar md:translate-x-0 transition-all duration-500"
    aria-label="Sidebar">
    {{-- logo area --}}
    <div class="h-20 mb-2 border-b-[1px] border-main2 px-3 relative">
        <div class="flex gap-x-4 absolute top-[50%] -translate-y-[50%] p-2">
            <img src="{{ asset('img/logo.png') }}" alt="" class="object-contain w-7 h-7 my-auto">
            <h1 class="font-semibold text-white text-[21px] my-auto">{{ config('services.aplication.AppName') }}</h1>
        </div>
    </div>
    <div class="h-full px-3 pb-[290px] overflow-y-auto bg-Sidebar relative w-64 scrollbar">
        <ul class="space-y-2 font-medium">
            <h1 class="text-gray-400 text-sm">MENU</h1>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group relative">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ml-3 font-semibold">Dashboard</span>

                    @if (request()->routeIs('Dashboard*'))
                        <span class="absolute w-[5px] h-full bg-orange-500 right-0"></span>
                    @endif
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75">
                        <path
                            d="M21 5H12.4142L10.4142 3H3C2.44772 3 2 3.44772 2 4V20C2 20.5523 2.44772 21 3 21H21C21.5523 21 22 20.5523 22 20V6C22 5.44772 21.5523 5 21 5ZM15.0008 12.667C15.1846 12.7895 15.2343 13.0379 15.1117 13.2217C15.0824 13.2656 15.0447 13.3033 15.0008 13.3326L10.1219 16.5852C9.9381 16.7078 9.6897 16.6581 9.5672 16.4743C9.5234 16.4086 9.5 16.3314 9.5 16.2524V9.74717C9.5 9.52625 9.6791 9.34717 9.9 9.34717C9.979 9.34717 10.0562 9.37054 10.1219 9.41435L15.0008 12.667Z"
                            fill="currentColor"></path>
                    </svg>
                    <span class="ml-3 font-semibold">Video Kajian</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75">
                        <path
                            d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM7 6V10H11V6H7ZM7 12V14H17V12H7ZM7 16V18H17V16H7ZM13 7V9H17V7H13Z"
                            fill="currentColor"></path>
                    </svg>
                    <span class="ml-3 font-semibold">Artikel</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75">
                        <path
                            d="M2 3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934ZM12 5V19H20V5H12ZM13 7H19V9H13V7ZM13 10H19V12H13V10Z"
                            fill="currentColor"></path>
                    </svg>
                    <span class="ml-3 font-semibold">Majalah Addiya</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75">
                        <path
                            d="M21 13V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V13H2V11L3 6H21L22 11V13H21ZM5 13V19H19V13H5ZM6 14H14V17H6V14ZM3 3H21V5H3V3Z"
                            fill="currentColor"></path>
                    </svg>
                    <span class="ml-3 font-semibold">Santri Store</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75">
                        <path
                            d="M7 1V3H3C2.44772 3 2 3.44772 2 4V20C2 20.5523 2.44772 21 3 21H10.7546C9.65672 19.6304 9 17.8919 9 16C9 11.5817 12.5817 8 17 8C18.8919 8 20.6304 8.65672 22 9.75463V4C22 3.44772 21.5523 3 21 3H17V1H15V3H9V1H7ZM23 16C23 19.3137 20.3137 22 17 22C13.6863 22 11 19.3137 11 16C11 12.6863 13.6863 10 17 10C20.3137 10 23 12.6863 23 16ZM16 12V16.4142L18.2929 18.7071L19.7071 17.2929L18 15.5858V12H16Z"
                            fill="currentColor"></path>
                    </svg>
                    <span class="ml-3 font-semibold">Jadwal Kegiatan</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75">
                        <path
                            d="M22.0049 9.99979V19.9998C22.0049 20.5521 21.5572 20.9998 21.0049 20.9998H3.00488C2.4526 20.9998 2.00488 20.5521 2.00488 19.9998V9.99979H22.0049ZM22.0049 7.99979H2.00488V3.99979C2.00488 3.4475 2.4526 2.99979 3.00488 2.99979H21.0049C21.5572 2.99979 22.0049 3.4475 22.0049 3.99979V7.99979ZM15.0049 15.9998V17.9998H19.0049V15.9998H15.0049Z"
                            fill="currentColor"></path>
                    </svg>
                    <span class="ml-3 font-semibold">Pembayaran SPP</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75">
                        <path
                            d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 9.5C12.8284 9.5 13.5 8.82843 13.5 8C13.5 7.17157 12.8284 6.5 12 6.5C11.1716 6.5 10.5 7.17157 10.5 8C10.5 8.82843 11.1716 9.5 12 9.5ZM14 15H13V10.5H10V12.5H11V15H10V17H14V15Z"
                            fill="currentColor"></path>
                    </svg>
                    <span class="ml-3 font-semibold">Informasi Ma'had</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75">
                        <path
                            d="M17.409 19C16.633 16.6012 15.1323 15.1147 13.1434 13.3979C15.0238 11.8971 17.4071 11 20 11V3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H6V1H8V5H4V12C9.22015 12 13.6618 14.4616 15.3127 19H17.409ZM18 1V5H10V3H16V1H18ZM16.5 10C15.6716 10 15 9.32843 15 8.5C15 7.67157 15.6716 7 16.5 7C17.3284 7 18 7.67157 18 8.5C18 9.32843 17.3284 10 16.5 10Z"
                            fill="currentColor"></path>
                    </svg>
                    <span class="ml-3 font-semibold">Gallery</span>
                </a>
            </li>
            <h1 class="text-gray-400 text-sm">MONITORING</h1>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                    </svg>
                    <span class="ml-3 font-semibold">Sholat Jamaah</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M547.6 103.8L490.3 13.1C485.2 5 476.1 0 466.4 0H109.6C99.9 0 90.8 5 85.7 13.1L28.3 103.8c-29.6 46.8-3.4 111.9 51.9 119.4c4 .5 8.1 .8 12.1 .8c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.1 0 49.3-11.4 65.2-29c15.9 17.6 39.1 29 65.2 29c26.2 0 49.3-11.4 65.2-29c16 17.6 39.1 29 65.2 29c4.1 0 8.1-.3 12.1-.8c55.5-7.4 81.8-72.5 52.1-119.4zM499.7 254.9l-.1 0c-5.3 .7-10.7 1.1-16.2 1.1c-12.4 0-24.3-1.9-35.4-5.3V384H128V250.6c-11.2 3.5-23.2 5.4-35.6 5.4c-5.5 0-11-.4-16.3-1.1l-.1 0c-4.1-.6-8.1-1.3-12-2.3V384v64c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V384 252.6c-4 1-8 1.8-12.3 2.3z" />
                    </svg>
                    <span class="ml-3 font-semibold">Ngaji</span>
                </a>
            </li>

            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ml-3 font-semibold">Hafalan</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M224 256A128 128 0 1 1 224 0a128 128 0 1 1 0 256zM209.1 359.2l-18.6-31c-6.4-10.7 1.3-24.2 13.7-24.2H224h19.7c12.4 0 20.1 13.6 13.7 24.2l-18.6 31 33.4 123.9 36-146.9c2-8.1 9.8-13.4 17.9-11.3c70.1 17.6 121.9 81 121.9 156.4c0 17-13.8 30.7-30.7 30.7H285.5c-2.1 0-4-.4-5.8-1.1l.3 1.1H168l.3-1.1c-1.8 .7-3.8 1.1-5.8 1.1H30.7C13.8 512 0 498.2 0 481.3c0-75.5 51.9-138.9 121.9-156.4c8.1-2 15.9 3.3 17.9 11.3l36 146.9 33.4-123.9z" />
                    </svg>
                    <span class="ml-3 font-semibold">Wali Santri</span>
                </a>
            </li>
            <li>
                <a href="/admin" class="flex items-center p-2 text-gray-400 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="flex-shrink-0 w-5 h-5 fill-gray-400 transition duration-75"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z" />
                    </svg>
                    <span class="ml-3 font-semibold">Santri</span>
                </a>
            </li>
        </ul>

        {{-- menu bawa --}}
        <div class="fixed w-64 bottom-0 bg-Sidebar left-0 pt-2 px-3 pb-4">
            <div class="flex items-center p-2 text-gray-400 rounded-lg group">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                    class="w-5 h-5 fill-gray-400 transition duration-75"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                </svg>

                <span class="ml-3 font-semibold">Logout</span>

            </div>
            <div class="max-h-[50px] h-full w-full border-t-[1px] border-main2 flex gap-x-3 pt-2">
                <img src="{{ asset('img/myFoto.jpg') }}" alt=""
                    class="object-cover w-10 h-10 rounded-full my-auto">
                <div class="my-auto">
                    <h1 class="text-lg text-white">Ryan Yulianto</h1>
                    <h1 class="text-sm text-gray-300">Admin</h1>
                </div>
            </div>
        </div>
    </div>
</aside>



@push('scripts')
    <script>
        var dropdownSidebar = document.querySelectorAll('.dropdownSidebar');
        var arrowSidebar = document.querySelectorAll('.arrowSidebar');

        dropdownSidebar.forEach(function(element, index) {
            element.addEventListener('click', function() {
                arrowSidebar[index].classList.toggle('rotate-180');
            });
        });
    </script>
@endpush
