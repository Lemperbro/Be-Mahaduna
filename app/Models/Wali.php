<?php

namespace App\Models;

use App\Models\WaliRelasi;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wali extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes;
    protected $table = 'wali';
    protected $primaryKey = 'wali_id';


    protected $guarded = [
        'wali_id'
    ];

    protected $casts = [
        'password' => 'hashed'
    ];

    public function waliRelasi()
    {
        return $this->hasMany(WaliRelasi::class, 'wali_id', 'wali_id');
    }

}
