<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';


    protected $guarded = [
        'transaksi_id'
    ];

    public function tagihan(){
        return $this->belongsTo(Tagihan::class);
    }
}
