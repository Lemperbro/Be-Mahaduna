<?php

namespace App\Models;

use App\Models\Artikel;
use App\Models\ArtikelRelasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtikelKategori extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'artikel_kategori';
    protected $primaryKey = 'artikel_kategori_id';

    protected $guarded = [
        'artikel_kategori_id'
    ];

    public function artikel(){
        return $this->hasMany(Artikel::class,'artikel_id');
    }
    public function artikel_relasi(){
        return $this->hasMany(ArtikelRelasi::class, 'artikel_kategori_id');
    }
}
