<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Santri extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'santri';
    protected $primaryKey = 'santri_id';

    protected $guarded = [
        'santri_id'
    ];

    public function waliRelasi(){
        return $this->belongsTo(WaliRelasi::class);
    }
}
