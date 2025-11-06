<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends SpatieRole
{
    use LogsActivity;

    protected static $logName = 'roles-table';
    protected static $logAttributes = ['name', 'permissions'];
    protected static $logOnlyDirty = true;
    protected $guard = 'admin';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Role has been {$eventName}";
    }

    // Method to log permission changes
    public function syncPermissionsWithLogging(array $permissions)
    {
        $oldPermissions = $this->permissions->pluck('name')->toArray();
        $this->syncPermissions($permissions);
        $newPermissions = $this->permissions->pluck('name')->toArray();

        activity('permissions')
            ->performedOn($this)
            ->causedBy(auth()->user())
            ->withProperties([
                'old_permissions' => $oldPermissions,
                'new_permissions' => $newPermissions,
            ])
            ->log('Permissions updated for role');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName(static::$logName);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'ref_user_id')
                    ->withTimestamps();  // This is the pivot table name and foreign keys
    }
}
