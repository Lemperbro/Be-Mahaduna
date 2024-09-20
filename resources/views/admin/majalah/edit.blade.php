@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="">
            <form action="{{ route('majalah.update', ['id' => $data->slug]) }}" method="POST" enctype="multipart/form-data"
                class="max-w-[800px] mx-auto flex flex-col my-auto justify-center min-h-screen pt-24">
                @csrf
                <div>
                    <label>Banner Image</label>
                    <input type="text" name="bannerImage" id="bannerImage" class="hidden">
                    <input type="file" id="bannerImageUploader"
                        class="w-full bg-white border border-main3 focus:ring-0 focus:outline-none focus:border-main2 rounded-md mt-1 @error('bannerImage')
                            peer
                        @enderror">
                    @error('bannerImage')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="majalahFile">File Majalah (PDF)</label>
                    <input type="file" name="majalahFile" id="majalahFile"
                        class="w-full bg-white border border-main3 focus:ring-0 focus:outline-none focus:border-main2 rounded-md mt-1 @error('majalahFile')
                            peer
                        @enderror">
                    @error('majalahFile')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul"
                        class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1 @error('judul')
                            peer
                        @enderror"
                        value="{{ $data->judul }}" required>
                    @error('judul')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex gap-2 mt-7">
                    <a href="{{ route('majalah.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md">Batal</a>
                    <button type="submit" class="bg-SidebarActive hover:bg-Sidebar py-2 px-4 text-white rounded-md"
                        id="submitBtn">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('head')
    {{-- filePond --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <style>
        .filepond--credits {
            display: none;
        }

        .filepond--panel-root {
            background-color: transparent;
        }

        .select2-selection.select2-selection--multiple {
            min-height: 50px;
            padding-top: 7px;
            padding-left: 7px;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    {{-- filepond start --}}
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-metadata/dist/filepond-plugin-file-metadata.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="{{ asset('js/filePondSingleConfig.js') }}"></script>
    {{-- filepond end  --}}
    <script>
        $(document).ready(function() {
            // filePond start
            const oldImageData = @json($data->bannerImage);
            const appUrl = "{{ $appUrl }}";

            function ensureFullUrl(path) {
                if (path.startsWith('http://') || path.startsWith('https://')) {
                    return path;
                }
                return appUrl + '/' + path;
            }
            const fullUrl = ensureFullUrl(oldImageData);

            axios.head(fullUrl)
                .then(response => {
                    const sizeImage = response.headers['content-length'];
                    $('#bannerImageUploader').filepond({
                        allowMultiple: false,
                        name: 'imageName',
                        acceptedFileTypes: ['image/jpeg', 'image/png', 'image/jpg'],
                        labelFileTypeNotAllowed: 'Hanya diperbolehkan file JPG,PNG dan JPEG',
                        maxFileSize: '1MB',
                        labelMaxFileSizeExceeded: 'Ukuran file melebihi batas maksimum (1MB)',
                        files: [{
                            source: fullUrl,
                            options: {
                                type: 'local',
                                file: {
                                    name: 'Banner Image Data',
                                    size: sizeImage
                                },
                                metadata: {
                                    poster: fullUrl,
                                },
                            }
                        }],
                    });
                    filePondConfig('majalahImage', '{{ csrf_token() }}', '#bannerImage', '#submitBtn');
                })
                .catch(error => {
                    console.error('Error fetching image size:', error);
                });
            FilePond.registerPlugin(FilePondPluginFileEncode, FilePondPluginImagePreview, FilePondPluginFilePoster,
                FilePondPluginFileValidateType, FilePondPluginFileValidateSize);
            // filePond end
        });
    </script>
@endpush
