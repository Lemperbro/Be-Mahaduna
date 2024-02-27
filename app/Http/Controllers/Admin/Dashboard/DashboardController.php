<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(){
        $headerTitle = 'Dashboard';
        return view('admin.dashboard.index', compact('headerTitle'));
    }
}
