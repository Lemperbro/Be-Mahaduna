<?php

namespace App\Models;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonitorMingguan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'monitor_mingguan';
    protected $primaryKey = 'monitor_mingguan_id';


    protected $guarded = [
        'monitor_mingguan_id'
    ];

    public function santri(){
        return $this->belongsTo(Santri::class, 'santri_id', 'santri_id');
    }
}
