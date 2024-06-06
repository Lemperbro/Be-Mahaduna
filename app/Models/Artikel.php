<?php

namespace App\Models;

use App\Models\ArtikelRelasi;
use App\Models\ArtikelKategori;
use App\Traits\HasNotification;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Artikel extends Model
{
    use HasFactory, Sluggable, SoftDeletes, HasNotification, Notifiable;
    protected $table = 'artikel';
    protected $primaryKey = 'artikel_id';


    protected $guarded = [
        'artikel_id'
    ];

    /**
     * @return array
     */
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
    public function artikel_kategori()
    {
        return $this->hasMany(ArtikelKategori::class, 'artikel_kategori_id');
    }
    public function artikel_relasi()
    {
        return $this->hasMany(ArtikelRelasi::class, 'artikel_id');
    }
     /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->fcm_token();
    }

}
