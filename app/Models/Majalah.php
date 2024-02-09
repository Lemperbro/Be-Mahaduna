<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Majalah extends Model
{
    use HasFactory,Sluggable, SoftDeletes;
    protected $table = 'majalah';
    protected $primaryKey = 'majalah_id';


    protected $guarded = [
        'majalah_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }
}
