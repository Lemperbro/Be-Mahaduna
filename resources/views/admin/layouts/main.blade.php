@include('admin.partials.start')



@include('admin.partials.sidebar')

<div id="main-content" class="relative overflow-y-auto lg:ml-80  px-4 min-h-screen pb-10">
    <main class="relative max-w-full">
        @yield('container')
        <main>


</div>


@include('admin.partials.end')
