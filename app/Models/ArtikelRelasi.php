<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtikelRelasi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'artikel_relasi';
    protected $primaryKey = 'artikel_relasi_id';


    protected $guarded = [
        'artikel_relasi_id'
    ];
}
