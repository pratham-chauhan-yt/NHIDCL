<?php

namespace App\Http\Controllers\Admin\HrSettings;

use App\Http\Controllers\Controller;

class HrSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:HR'); 
    }

    public function index(){
        $header = true;
        $sidebar = true;
        return view("hr-settings.index", compact("header", "sidebar"));
    }
}
