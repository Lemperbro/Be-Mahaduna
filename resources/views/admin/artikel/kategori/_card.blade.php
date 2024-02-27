
@foreach ($allKategori as $key => $item) 
        <div class="border rounded-lg bg-white p-4 ">
            <h3>{{ $item->kategori }}</h3>
            <div class="mt-4">
                @include('admin.artikel.kategori._actionCard')
            </div>
            @include('admin.artikel.kategori._modalEditKategoriArtikel')
            @include('admin.artikel.kategori._modaldeleteKategoriArtikel')
        </div>
@endforeach
