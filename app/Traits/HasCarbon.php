<?php
namespace App\Traits;

use Carbon\Carbon;

trait HasCarbon
{

    function field($key)
    {
        return $this->attributes[$key];
    }
    function date($date, $format = 'MMMM YYYY')
    {
        $date = $this->field($date);
        return Carbon::parse($date)->locale('id')->isoFormat($format);
    }
}