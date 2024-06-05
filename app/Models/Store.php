<?php

namespace App\Models;

use App\Models\StoreImage;
use App\Notifications\NewUploadsNotification;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use HasFactory, Sluggable, SoftDeletes, Notifiable;
    protected $table = 'store';
    protected $primaryKey = 'store_id';
    private $title = 'Kajian';



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
    public function store_image()
    {
        return $this->hasMany(StoreImage::class, 'store_id', 'store_id');
    }
    public function sendNotification()
    {

        $this->notify(new NewUploadsNotification(title: $this->title, message: $this->title));
    }

}
