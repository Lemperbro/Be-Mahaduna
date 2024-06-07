@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="">
            <form action="{{ route('store.update', ['id' => $data->slug]) }}" method="POST" enctype="multipart/form-data"
                class="max-w-[800px] mx-auto flex flex-col my-auto justify-center min-h-screen pt-24">
                @csrf
                <div class="relative overflow-y-auto">
                    <label for="">Image (JPEG,PNG,JPG)</label>
                    <p class="text-gray-600 mt-2">Catatan: Jika gambar sisa 1 maka gambar tidak akan bisa di hapus, silahkan
                        tambah gambar dan simpan</p>
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
                    <div class="hidden" id="invalidSaveImage">
                        <div id="alertInvalidSaveImage"
                            class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium capitalize">
                                tidak berhasil menghapus gambar, harus menyisahkan 1 gambar yang tersimpan
                            </div>
                            <button type="button"
                                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                                data-dismiss-target="#alertInvalidSaveImage" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="label">Title</label>
                    <input type="text" name="label" id="label"
                        class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 @error('label')
                    peer
                @enderror"
                        value="{{ $data->label }}">
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
                @enderror"
                        value="{{ $data->price }}">
                    @error('price')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock"
                        class="w-full p-2 rounded-md  border-main3  focus:ring-0 focus:outline-none focus:border-main2 mt-1 @error('stock')
                    peer
                @enderror"
                        value="{{ $data->stock }}">
                    @error('stock')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"
                        class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1">
                    {{ $data->deskripsi }}
                    </textarea>
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
    <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet" />
    <style>
        /* filepond start */
        .filepond--credits {
            display: none;
        }

        .filepond--panel-root {
            background-color: transparent;
            position: relative;

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
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="{{ asset('js/filePondMultipleConfig.js') }}"></script>
    <script>
        $(document).ready(function() {
            let oldImageData = @json($data->store_image->pluck('image'));
            const appUrl = "{{ $appUrl }}";

            // Fungsi untuk memastikan URL lengkap
            function ensureFullUrl(path) {
                if (path.startsWith('http://') || path.startsWith('https://')) {
                    return path;
                }
                return appUrl + '/' + path;
            }

            // Ubah oldImageData menjadi URL lengkap
            oldImageData = oldImageData.map(image => ensureFullUrl(image));
            let store_id = @json($data->store_id);

            // filePond start
            FilePond.registerPlugin(FilePondPluginFileEncode, FilePondPluginImagePreview, FilePondPluginFilePoster,
                FilePondPluginFileValidateType, FilePondPluginFileValidateSize);

            async function getImagesWithSizes() {
                const imageDataArray = await Promise.all(oldImageData.map(async (imageURL) => {
                    // Fetch image header and extract size
                    try {
                        const response = await axios.head(imageURL);
                        const size = response.headers['content-length'];

                        return {
                            source: imageURL,
                            options: {
                                type: 'local',
                                file: {
                                    name: 'Data Gambar',
                                    size: size,
                                },
                                metadata: {
                                    poster: imageURL,
                                },
                            }
                        };
                    } catch (error) {
                        console.error('Error fetching image size:', error);
                    }
                }));

                return imageDataArray.filter(image => image); // Hapus undefined dari hasil
            }

            (async () => {
                // Wait for image data and sizes
                const imageDataWithSizes = await getImagesWithSizes();

                $('#imageUploader').filepond({
                    allowMultiple: true,
                    acceptedFileTypes: ['image/jpeg', 'image/png', 'image/jpg'],
                    labelFileTypeNotAllowed: 'Hanya diperbolehkan file JPG,PNG dan JPEG',
                    maxFileSize: '1MB',
                    labelMaxFileSizeExceeded: 'Ukuran file melebihi batas maksimum (1MB)',
                    files: imageDataWithSizes,
                    name: 'imageName',
                    onremovefile: async (error, file) => {
                        if (typeof file.source === 'string') {
                            try {
                                if (typeof file.source === 'string') {
                                    await axios.post(
                                        `/store/image/delete/filepond/storeImage`, {
                                            imageName: file.source,
                                            store_id: store_id
                                        });
                                }
                            } catch (error) {
                                $('#invalidSaveImage').removeClass('hidden');
                                $('#alertInvalidSaveImage').removeClass('opacity-0');
                                $('#alertInvalidSaveImage').removeClass('hidden');
                                const imageData = await showImageLagi(file.source);
                                $('#imageUploader').filepond('files', imageData);
                            }
                        }
                    },
                });

                async function showImageLagi(image) {
                    try {
                        const response = await axios.head(image);
                        const sizeImage = response.headers['content-length'];

                        return [{
                            source: image,
                            options: {
                                type: 'local',
                                file: {
                                    name: 'Data Gambar',
                                    size: sizeImage,
                                },
                                metadata: {
                                    poster: image,
                                },
                            }
                        }];
                    } catch (error) {
                        console.error('Error fetching image size:', error);
                    }
                }
            })();

            filePondConfig('storeImage', '{{ csrf_token() }}', '#image', '#submitBtn');
            // filepond end
        });
    </script>
@endpush
