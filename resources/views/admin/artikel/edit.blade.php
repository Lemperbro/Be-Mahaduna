@extends('admin.layouts.main')


@section('container')
    <section>
        @include('admin.partials._header')
        <div class="">
            <form action="{{ route('artikel.update', ['id' => $data->slug]) }}" method="POST"
                class="max-w-[800px] mx-auto flex flex-col my-auto justify-center min-h-screen pt-24 "
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="bannerImage">Banner Image </label>
                    <input type="file" name="bannerImage" id="bannerImage"
                        class="w-full bg-white border border-main3 focus:ring-0 focus:outline-none focus:border-main2 rounded-md mt-1">
                </div>
                <div class="mt-4">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul"
                        class="w-full p-2 rounded-md  border-main3 focus:ring-0 focus:outline-none focus:border-main2 mt-1" value="{{ $data->judul }}">
                </div>
                <div class="mt-4">
                    <label for="kategori">Kategori</label>
                    <div class="mt-1">
                        <select name="kategori[]" id="kategori"
                            class="kategoriSelect w-full border border-main3 focus:ring-0 focus:outline-none focus:border-main2"
                            multiple>
                            @foreach ($kategori as $key => $item)
                                <option value="{{ $item->artikel_kategori_id }}" {{ $data->artikel_relasi->contains('artikel_kategori_id', $item->artikel_kategori_id) ? 'selected' : '' }}>{{ $item->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="isi">Isi Artikel</label>
                    <div class="mt-1">
                        <textarea name="isi" id="isi" cols="30" rows="10"
                            class="mt-1 border-main3 focus:ring-0 focus:outline-none focus:border-main2">
                                {{ $data->isi }}
                        </textarea>
                    </div>
                </div>

                <div class="flex gap-2 mt-7">
                    <a href="{{ route('artikel.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md">Batal</a>
                    <button type="submit"
                        class="bg-SidebarActive hover:bg-Sidebar py-2 px-4 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('froala/css/froala_editor.pkgd.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/listFroala.css') }}">

    <style>
        .select2-selection.select2-selection--multiple {
            min-height: 50px;
            padding-top: 7px;
            padding-left: 7px;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('froala/js/froala_editor.pkgd.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var editor = new FroalaEditor('#isi', {
                contentStyles: {
                    'ol': 'list-style-type: decimal;',
                    // Tambahkan definisi CSS lain sesuai kebutuhan Anda
                },
                // Konfigurasi unggah gambar
                imageUploadURL: '/froala-upload-image', // Replace with your actual route
                imageUploadParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                imageUploadMethod: 'POST',
                events: {
                    'image.removed': function(img) {
                        // Panggil fungsi untuk menghapus gambar dari server
                        handleImageRemoval(img[0].currentSrc);
                    }
                }
            });

            function handleImageRemoval(image) {
                // Menggunakan API Froala Editor untuk mendapatkan URL gambar
                var imageUrl = image;
                var formData = new FormData();
                formData.append('image_url', imageUrl);

                fetch('/froala-delete-image', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {})
                    .catch(error => {});
            }

            $('.kategoriSelect').select2({
                width: 'resolve',
                placeholder: "Pilih Kategori",
                language: {
                    noResults: function() {
                        return "Kategori tidak ditemukan";
                    }
                }
            });
        });
    </script>
@endpush
