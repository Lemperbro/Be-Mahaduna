<?php

namespace App\Observers;

use App\Models\Artikel;
use App\Notifications\NewUploadsNotification;

class ArtikelObserver
{
    private $titleNotif = 'Artikel';
    /**
     * Handle the Artikel "created" event.
     */
    public function created(Artikel $artikel): void
    {
        $artikel->pushNotifikasi(titleNotif: $this->titleNotif, messageNotif: $artikel->judul);
    }

    /**
     * Handle the Artikel "updated" event.
     */
    public function updated(Artikel $artikel): void
    {
        //
    }

    /**
     * Handle the Artikel "deleted" event.
     */
    public function deleted(Artikel $artikel): void
    {
        //
    }

    /**
     * Handle the Artikel "restored" event.
     */
    public function restored(Artikel $artikel): void
    {
        //
    }

    /**
     * Handle the Artikel "force deleted" event.
     */
    public function forceDeleted(Artikel $artikel): void
    {
        //
    }
}
