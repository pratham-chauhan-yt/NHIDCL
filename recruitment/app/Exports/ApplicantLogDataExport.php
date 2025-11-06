<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ApplicantLogDataExport implements FromView
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {   
        return view('recruitment-management.Candidate.export-applicant-logs', ['data' => $this->data]);
    }
}
