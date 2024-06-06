<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Models\Wali;
use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    public function countSantri()
    {
        return Santri::count();
    }
    public function countWali()
    {
        return Wali::count();
    }

    public function index()
    {
        $headerTitle = 'Dashboard';
        $hour = now()->format('H');
        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour >= 12 && $hour < 16) {
            $greeting = 'Selamat Siang';
        } elseif ($hour >= 16 && $hour < 19) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }
        $countSantri = $this->countSantri();
        $countWali = $this->countWali();
        return view('admin.dashboard.index', compact('headerTitle', 'greeting', 'countWali', 'countSantri'));
    }

}
