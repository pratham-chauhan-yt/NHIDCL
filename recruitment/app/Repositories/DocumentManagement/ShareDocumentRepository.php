<?php
namespace App\Repositories\DocumentManagement;

use App\Models\DocumentManagement\NhidclDmsShareDocument;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ShareDocumentRepository
{
    protected string $table = 'nhidcl_dms_share_document';

    public function baseQuery(): Builder
    {
        return NhidclDmsShareDocument::query()
            ->select("{$this->table}.*")
            ->with(['user', 'creator', 'approver', 'status']); // relations for filterColumn
    }

    public function forRendering(string $rendering): Builder
    {
        $query = $this->baseQuery();

        switch ($rendering) {
            case 'Shared-Documents':
                return $this->applySharedDocuments($query);

            case 'Received-Documents':
                return $this->applyReceivedDocuments($query);

            case 'Approval-Pending':
                return $this->applyApprovalPending($query);

            case 'Approved-Archive':
                return $this->applyApprovedArchive($query);

            default:
                return $query;
        }
    }

    protected function applySharedDocuments(Builder $query): Builder
    {
        return $query->where("{$this->table}.created_by", Auth::id())
            ->leftJoin('ref_users as shared_with_users', 'shared_with_users.id', '=', "{$this->table}.ref_users_id")
            ->leftJoin('ref_users as approver_users', 'approver_users.id', '=', "{$this->table}.approved_or_rejected_by")
            ->addSelect([
                'shared_with_users.name as shared_with_name',
                'shared_with_users.email as shared_with_email',
                'approver_users.name as approver_name',
                'approver_users.email as approver_email',
            ]);
    }

    protected function applyReceivedDocuments(Builder $query): Builder
    {
        return $query->where("{$this->table}.ref_users_id", Auth::id())
            ->leftJoin('ref_users as shared_by_users', 'shared_by_users.id', '=', "{$this->table}.created_by")
            ->addSelect([
                'shared_by_users.name as shared_by_name',
                'shared_by_users.email as shared_by_email',
            ]);
    }

    protected function applyApprovalPending(Builder $query): Builder
    {
        return $query->where("{$this->table}.ref_status_id", 1)
            ->whereHas('creator', fn($q) => $q->where('dms_approver_id', Auth::id()))
            ->leftJoin('ref_users as shared_with_users', 'shared_with_users.id', '=', "{$this->table}.ref_users_id")
            ->leftJoin('ref_users as shared_by_users', 'shared_by_users.id', '=', "{$this->table}.created_by")
            ->addSelect([
                'shared_with_users.name as shared_with_name',
                'shared_with_users.email as shared_with_email',
                'shared_by_users.name as shared_by_name',
                'shared_by_users.email as shared_by_email',
            ]);
    }

    protected function applyApprovedArchive(Builder $query): Builder
    {
        return $query->whereIn("{$this->table}.ref_status_id", [3, 4])
            ->where("{$this->table}.approved_or_rejected_by", Auth::id())
            ->leftJoin('ref_users as shared_with_users', 'shared_with_users.id', '=', "{$this->table}.ref_users_id")
            ->leftJoin('ref_users as shared_by_users', 'shared_by_users.id', '=', "{$this->table}.created_by")
            ->addSelect([
                'shared_with_users.name as shared_with_name',
                'shared_with_users.email as shared_with_email',
                'shared_by_users.name as shared_by_name',
                'shared_by_users.email as shared_by_email',
            ]);
    }
}
