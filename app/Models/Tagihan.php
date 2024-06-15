<?php

namespace App\Models;

use App\Traits\HasCarbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use HasFactory, SoftDeletes, HasCarbon;
    protected $table = 'tagihan';
    protected $primaryKey = 'tagihan_id';


    protected $guarded = [
        'tagihan_id'
    ];
    // protected $casts = [
    //     'date' => 'date:Y-m-d'
    // ];
    // protected $dates = [
    //     'date'
    // ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'tagihan_id', 'tagihan_id');
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id', 'santri_id');
    }
}
