<?php

namespace App\ViewComposers;

use App\Models\Artikel;
use App\Models\Majalah;
use App\Models\PlaylistVideo;
use App\Models\Store;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with([
            'kajianCount' => PlaylistVideo::count(),
            'artikelCount' => Artikel::count(),
            'majalahCount' => Majalah::count(),
            'storeCount' => Store::count()
        ]);
    }
}