<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Models\DesignationMaster;

class DesignationController extends MasterCrudController
{
    protected $model = DesignationMaster::class;
    protected $view = 'master-settings.designation';
    protected $field = 'name';
    protected $title = 'Designation';
    protected $routePrefix = 'master-settings.designation';
}
