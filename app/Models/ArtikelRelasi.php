<?php

namespace App\Models;

use App\Models\Artikel;
use App\Models\ArtikelKategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtikelRelasi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'artikel_relasi';
    protected $primaryKey = 'artikel_relasi_id';
    // Di dalam model ArtikelRelasi



    protected $guarded = [
        'artikel_relasi_id'
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'artikel_id', 'artikel_id');
    }
    public function artikel_kategori()
    {
        return $this->belongsTo(ArtikelKategori::class, 'artikel_kategori_id', 'artikel_kategori_id');
    }
}
