<?php

namespace App\Observers;

use App\Models\Majalah;

class MajalahObserver
{
    private $titleNotif = 'Majalah';

    /**
     * Handle the Majalah "created" event.
     */
    public function created(Majalah $majalah): void
    {
        $majalah->pushNotifikasi(titleNotif: $this->titleNotif, messageNotif: $majalah->judul);
    }

    /**
     * Handle the Majalah "updated" event.
     */
    public function updated(Majalah $majalah): void
    {
        //
    }

    /**
     * Handle the Majalah "deleted" event.
     */
    public function deleted(Majalah $majalah): void
    {
        //
    }

    /**
     * Handle the Majalah "restored" event.
     */
    public function restored(Majalah $majalah): void
    {
        //
    }

    /**
     * Handle the Majalah "force deleted" event.
     */
    public function forceDeleted(Majalah $majalah): void
    {
        //
    }
}
