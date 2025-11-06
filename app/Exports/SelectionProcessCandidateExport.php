<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SelectionProcessCandidateExport implements FromView
{
    protected $users;
    protected $category;
    protected $disability;

    public function __construct($users, $category, $disability)
    {
        $this->users = $users;
        $this->category = $category;
        $this->disability = $disability;
    }

    public function view(): View
    {   
        return view('recruitment-management.Candidate.export-applicant', ['previewData' => $this->users, 'categoryCounts' => $this->category, 'disabilityCounts' => $this->disability]);
    }
}
