<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class ApplicationStepCompleted
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user(); // Or get user by token/session
        $routeName = $request->route()->getName();

        // Define the steps and their dependencies in order
        $stepDependencies = [
            'educational-details'        => 'personal-details',
            'work-experience-details'    => 'educational-details',
            'final-clouser.submition'    => 'work-experience-details',
        ];

        // Mapping of step => DB table to check for data
        $stepTableMap = [
            'personal-details'           => 'ref_applicant_personal_details',
            'educational-details'        => 'nhidcl_applicant_education_details',
            'work-experience-details'    => 'nhidcl_applicant_work_experience_details',
            'final-clouser.submition'    => 'final_submission_table', // Replace with actual table name
        ];

        if (isset($stepDependencies[$routeName])) {
            $requiredStep = $stepDependencies[$routeName];
            $requiredTable = $stepTableMap[$requiredStep] ?? null;

            if ($requiredTable) {
                $record = DB::table($requiredTable)->where('ref_users_id', $user->id)->first();

                if (!$record) {
                    return redirect()->route('candidate.applicantProfile')->withErrors([
                        'error' => 'Please complete the previous step before accessing this section.'
                    ]);
                }
            }
        }
        return $next($request);
    }
}
