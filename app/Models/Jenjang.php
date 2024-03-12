<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    use HasFactory;
    protected $table = 'jenjang';
    protected $primaryKey = 'jenjang_id';
    protected $guarded = [
        'jenjang_id'
    ];

    public function santri()
    {
        return $this->hasMany(Santri::class, 'jenjang_id', 'jenjang_id');
    }
}
