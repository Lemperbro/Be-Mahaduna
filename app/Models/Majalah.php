<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Majalah extends Model
{
    use HasFactory, Sluggable, SoftDeletes;
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

    public function generateSlugOnUpdate()
    {
        $this->slug = SlugService::createSlug($this, 'slug', $this->judul);
    }
}
