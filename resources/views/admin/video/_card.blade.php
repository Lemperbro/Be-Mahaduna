@use('Carbon\Carbon')

@foreach ($playlist->items() as $key => $item)
    <div class="inline-block bg-white relative rounded-lg shadow-md">
        <div class="bg-gray-400 absolute left-[50%] -translate-x-[50%] w-[95%] h-40 -top-2 rounded-lg -z-[1]"></div>
        <a href="" class="relative rounded-lg overflow-hidden inline-block">
            <figure class="relative">
                <div class="absolute bottom-[50px] right-5 bg-black/80 px-2 py-1 rounded-lg min-w-20 ">
                    <div class="flex gap-2 items-center">
                        <i class="ri-play-list-2-fill text-white"></i>
                        <h5 class="text-white text-sm">{{ $item->contentDetails->itemCount }} video</h5>
                    </div>
                </div>
                <img src="{{ $item->snippet->thumbnails->high->url }}" alt=""
                    class="h-full w-full object-contain rounded-lg">
            </figure>
        </a>
        <div class="px-2 py-4">
            <div class="mb-2">
                @include('admin.video._actionCard')
            </div>
            <h1 class="line-clamp-2 font-semibold text-lg text-Sidebar">{{ $item->snippet->title }}</h1>

            <div class="mt-5">
                <p class="text-sm text-gray-600">Diupload</p>
                <p class="text-sm text-gray-600">
                    {{ Carbon::parse($item->snippet->publishedAt)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}</p>
            </div>
        </div>
    </div>



    
@endforeach
