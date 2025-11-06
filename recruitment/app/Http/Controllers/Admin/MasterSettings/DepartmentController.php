<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Models\DepartmentMaster;

class DepartmentController extends MasterCrudController
{
    protected $model = DepartmentMaster::class;
    protected $view = 'master-settings.department';
    protected $field = 'name';
    protected $title = 'Department';
    protected $routePrefix = 'master-settings.departments';
}
