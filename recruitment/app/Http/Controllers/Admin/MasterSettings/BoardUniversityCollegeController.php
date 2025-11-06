<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Models\RefBoardUniversityCollege;

class BoardUniversityCollegeController extends MasterCrudController
{
    protected $model = RefBoardUniversityCollege::class;
    protected $view = 'master-settings.boardUniversityCollege';
    protected $field = 'name';
    protected $title = 'Board/University/College';
    protected $routePrefix = 'master-settings.board-university-college';
}
