<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Super Admin'); 
    }

    public function index(){
        $header = true;
        $sidebar = true;
        return view("master-settings.index", compact("header", "sidebar"));
    }
}
