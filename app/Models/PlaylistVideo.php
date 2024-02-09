<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaylistVideo extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'playlist_video';
    protected $primaryKey = 'playlist_video_id';


    protected $guarded = [
        'playlist_video_id'
    ];
}
