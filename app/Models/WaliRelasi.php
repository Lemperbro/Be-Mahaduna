<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaliRelasi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'wali_santri_relasi';
    protected $primaryKey = 'wali_santri_relasi_id';


    protected $guarded = [
        'wali_santri_relasi_id'
    ];

    public function wali(){
        return $this->hasMany(Wali::class);
    }
    public function santri(){
        return $this->belongsTo(Santri::class);
    }
}
