@extends('admin.layouts.main')

@section('container')
    <section>
        @include('admin.partials._header')
        <div class="">
            <form action="{{ route('majalah.store') }}" method="POST" enctype="multipart/form-data"
                class="max-w-[800px] mx-auto flex flex-col my-auto justify-center min-h-screen pt-24">
                @csrf
                <div>
                    <label>Banner Image (JPEG,PNG,JPG)</label>
                    <input type="text" name="bannerImage" id="bannerImage" class="hidden">
                    <input type="file"  id="bannerImageUploader"
                        class="w-full bg-white border border-main3 focus:ring-0 focus:outline-none focus:border-main2 rounded-md mt-1 @error('bannerImage')
                            peer
                        @enderror"
                        required>
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
                        @enderror"
                        required>
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
                        required>
                    @error('judul')
                        <p class="peer-invalid:visible text-red-700 font-light">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex gap-2 mt-7">
                    <a href="{{ route('majalah.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md">Batal</a>
                    <button type="submit"
                        class="bg-SidebarActive hover:bg-Sidebar py-2 px-4 text-white rounded-md" id="submitBtn">Simpan</button>
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
    <script src="{{ asset('js/filePondSingleConfig.js') }}"></script>

    <script>
        $(document).ready(function() {
            // filepond start
            FilePond.registerPlugin(FilePondPluginFileEncode, FilePondPluginImagePreview,
                FilePondPluginFileValidateType, FilePondPluginFileValidateSize);
            $('#bannerImageUploader').filepond({
                allowMultiple: false,
                acceptedFileTypes: ['image/jpeg', 'image/png', 'image/jpg'],
                labelFileTypeNotAllowed: 'Hanya diperbolehkan file JPG,PNG dan JPEG',
                maxFileSize: '1MB',
                labelMaxFileSizeExceeded: 'Ukuran file melebihi batas maksimum (1MB)',
                name: 'imageName',
            });
            filePondConfig('majalahImage', '{{ csrf_token() }}', '#bannerImage', '#submitBtn');
            // filepond end
        });
    </script>
@endpush
