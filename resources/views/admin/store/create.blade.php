@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="">
            <form action="{{ route('store.create.store') }}" method="POST" enctype="multipart/form-data"
                class="max-w-[800px] mx-auto flex flex-col my-auto justify-center min-h-screen pt-24">
                @csrf
                <div>
                    <label for="">Image (JPEG,PNG,JPG)</label>
                    <input type="text" name="image" id="image" class="hidden">
                    <input type="file" id="imageUploader"
                        class="w-full bg-white border border-main3 focus:ring-0 focus:outline-none focus:border-main2 rounded-md mt-1 @error('image')
                    peer
                @enderror"
                        required multiple>

                    @error('image')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="label">Title</label>
                    <input type="text" name="label" id="label"
                        class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 @error('label')
                    peer
                @enderror">
                    @error('label')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="price">Harga</label>
                    <input type="number" name="price" id="price"
                        class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 @error('price')
                    peer
                @enderror">
                    @error('price')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock"
                        class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 @error('stock')
                    peer
                @enderror">
                    @error('stock')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"
                        class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1"></textarea>
                </div>
                <div class="flex gap-2 mt-7">
                    <a href="{{ route('store.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md">Batal</a>
                    <button type="submit" class="bg-SidebarActive hover:bg-Sidebar py-2 px-4 text-white rounded-md"
                        id="submitBtn">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('head')
    {{-- plugin filepond --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <style>
        /* filepond start */
        .filepond--credits {
            display: none;
        }

        .filepond--panel-root {
            background-color: transparent;
        }

        .filepond--root {
            max-height: 50em;
        }


    </style>
@endpush
@push('scripts')
    <!-- include FilePond library -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    <!-- include FilePond plugins -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

    <!-- include FilePond jQuery adapter -->
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    {{-- plugin filepond --}}
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="{{ asset('js/filePondMultipleConfig.js') }}"></script>
    <script>
        $(document).ready(function() {
            // filepond start
            FilePond.registerPlugin(FilePondPluginFileEncode, FilePondPluginImagePreview,
                FilePondPluginFileValidateType, FilePondPluginFileValidateSize);
            $('#imageUploader').filepond({
                allowMultiple: true,
                acceptedFileTypes: ['image/jpeg', 'image/png', 'image/jpg'],
                labelFileTypeNotAllowed: 'Hanya diperbolehkan file JPG,PNG dan JPEG',
                maxFileSize: '1MB',
                labelMaxFileSizeExceeded: 'Ukuran file melebihi batas maksimum (1MB)',
                name: 'imageName',
            });
            filePondConfig('storeImage', '{{ csrf_token() }}', '#image', '#submitBtn');
            // filepond end
        });
    </script>
@endpush
