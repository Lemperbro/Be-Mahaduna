<?php

namespace App\Models;

use App\Models\StoreImage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory, Sluggable, SoftDeletes;
    protected $table = 'store';
    protected $primaryKey = 'store_id';


    protected $guarded = [
        'store_id'
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'label'
            ]
        ];
    }
    public function generateSlugOnUpdate()
    {
        $this->slug = SlugService::createSlug($this, 'slug', $this->label);
    }
    public function store_image(){
        return $this->hasMany(StoreImage::class, 'store_id','store_id');
    }

}
