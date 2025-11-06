<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Models\RefOfficeType;

class OfficeTypeController extends MasterCrudController
{
    protected $model = RefOfficeType::class;
    protected $view = 'master-settings.office_type';
    protected $field = 'office_type_name';
    protected $title = 'Office Type';
    protected $routePrefix = 'master-settings.office-type';
}
