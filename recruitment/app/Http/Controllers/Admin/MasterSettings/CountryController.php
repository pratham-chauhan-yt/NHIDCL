<?php

namespace App\Http\Controllers\Admin\MasterSettings;

use App\Models\RefCountry;

class CountryController extends MasterCrudController
{
    protected $model = RefCountry::class;
    protected $view = 'master-settings.country';
    protected $field = 'country_name';
    protected $title = 'Country';
    protected $routePrefix = 'master-settings.countries';
}
