@foreach ($data as $key => $item)
    <div class="relative flex w-full max-w-[26rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
        <div
            class="relative mx-4 mt-4 overflow-hidden text-white shadow-lg rounded-xl bg-blue-gray-500 bg-clip-border shadow-blue-gray-500/40 bg-black">
            <img src="{{ $item->store_image[0]->image }}" class="w-full h-64 object-contain items-center" />
        </div>
        <div class="p-6">
            <div>
                @include('admin.store._actionCard')
            </div>
            <div class="flex items-center justify-between mb-2 mt-2">
                <h5
                    class="block font-sans text-xl antialiased font-medium leading-snug tracking-normal text-blue-gray-900">
                    {{ $item->label }}
                </h5>
            </div>
            <div class="my-4">
                <p>
                    Rp. {{ number_format($item->price,0,',','.') }}
                </p>
                <p>
                    Stock {{ $item->stock }}
                </p>
            </div>
            <p class=" font-sans text-base antialiased font-light leading-relaxed text-gray-700 line-clamp-3">
                {{ $item->deskripsi }}
            </p>
        </div>
    </div>
@endforeach
