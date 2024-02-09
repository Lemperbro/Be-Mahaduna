<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonitorMingguan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'monitor_mingguan';
    protected $primaryKey = 'monitor_mingguan_id';


    protected $guarded = [
        'monitor_mingguan_id'
    ];
}
