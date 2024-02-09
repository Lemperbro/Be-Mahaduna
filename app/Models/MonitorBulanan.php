<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonitorBulanan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'monitor_bulanan';
    protected $primaryKey = 'monitor_bulanan_id';

    protected $guarded = [
        'monitor_bulanan_id'
    ];
}
