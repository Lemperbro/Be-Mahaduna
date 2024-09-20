<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreImage extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'store_image';
    protected $primaryKey = 'store_image_id';
    protected $guarded = [
        'store_image_id'
    ];


    public function store(){
        return $this->belongsTo(Store::class, 'store_id','store_id');
    }
}
