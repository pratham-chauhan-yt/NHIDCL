<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        // Build the query to fetch users based on filters
        $users = User::where('is_deleted', '!=', '1')
            ->select([
                'id',
                'user_code',
                'name',
                'email',
                'mobile',
                'ref_department_id',
                'is_logged',
                'ref_employee_type_id'
            ])
            ->with('roles'); // Eager load roles to optimize queries

        // Apply filters
        if ($this->filters['email'] ?? false) {
            $users->where('email', 'like', '%' . $this->filters['email'] . '%');
        }

        if ($this->filters['mobile'] ?? false) {
            $users->where('mobile', 'like', '%' . $this->filters['mobile'] . '%');
        }

        if ($this->filters['department'] ?? false) {
            $users->where('ref_department_id', $this->filters['department']);
        }

        if (!empty($this->filters['role'])) {
            $users->whereHas('roles', function ($query) {
                $query->where('roles.id', $this->filters['role']);
            });
        }

        // Get users data
        return $users->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Code',
            'Name',
            'Email',
            'Mobile',
            'Department ID',
            'Is Logged',
            'Employee Type ID',
        ];
    }
}

