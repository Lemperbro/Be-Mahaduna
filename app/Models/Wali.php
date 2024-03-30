<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wali extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'wali';
    protected $primaryKey = 'wali_id';


    protected $guarded = [
        'wali_id'
    ];


    public function waliRelasi(){
        return $this->hasMany(WaliRelasi::class, 'wali_id', 'wali_id');
    }
    
}
