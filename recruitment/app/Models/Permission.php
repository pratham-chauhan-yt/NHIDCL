<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends SpatiePermission
{
    use LogsActivity;

    protected static $logName = 'permissions-table';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName(static::$logName);
    }
}
