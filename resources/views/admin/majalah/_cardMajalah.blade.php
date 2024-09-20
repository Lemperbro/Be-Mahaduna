@use('Carbon\Carbon')
@foreach ($data as $key => $item)
    <div class="relative flex flex-col text-gray-700 bg-white shadow-md bg-clip-border rounded-xl">
        <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white bg-clip-border rounded-xl shadow-lg">
            <img src="{{ $item->bannerImage }}" alt="card-image" class="object-cover aspect-square rounded-xl border" />
            <div class="bg-black/80 absolute z-10 top-5 right-5 rounded-md ">
                <div class="flex gap-2 items-center px-2 py-1 ">
                    <i class="ri-eye-line text-xl text-white"></i>
                    <p class="text-white">{{ $item->views }}</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div>
                @include('admin.majalah._actionCard')
            </div>
            <div class="flex flex-col min-h-[100px] justify-between mt-2">
                <h1 class=" font-sans text-lg  antialiased font-medium leading-relaxed line-clamp-2 text-left">
                    {{ $item->judul }}
                </h1>
                <div class="w-full ">
                    <p class="text-gray-600 text-sm">
                        {{ Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endforeach
