<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtikelKategori extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'artikel_kategori';
    protected $primaryKey = 'artikel_kategori_id';
    protected $guarded = [
        'artikel_kategori_id'
    ];
}
