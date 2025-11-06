<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Models\RefState;

class StateController extends MasterCrudController
{
    protected $model = RefState::class;
    protected $view = 'master-settings.state';
    protected $field = 'name';
    protected $title = 'State';
    protected $routePrefix = 'master-settings.states';
}
