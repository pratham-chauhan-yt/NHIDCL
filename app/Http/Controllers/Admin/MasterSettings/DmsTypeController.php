<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Models\DocumentManagement\RefType;

class DmsTypeController extends MasterCrudController
{
    protected $model = RefType::class;
    protected $view = 'master-settings.dms-type';
    protected $field = 'type';
    protected $title = 'DMS Type';
    protected $routePrefix = 'master-settings.dms-type';
}
