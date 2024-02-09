<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'tagihan';
    protected $primaryKey = 'tagihan_id';


    protected $guarded = [
        'tagihan_id'
    ];

    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }

    public function santri(){
        return $this->belongsTo(Santri::class);
    }
}
