<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Recruitment\NhidclRecruitmentApplications;
use App\Models\Recruitment\NhidclRecruitmentApplicationsLogs;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UpdateApplicationsStatusCommand extends Command
{
    protected $signature = 'applications:update-status';
    protected $description = 'Automatically update application statuses and send emails for edit permission.';

    public function handle()
    {
        $now = Carbon::now('Asia/Kolkata');

        // Define time windows
        $startTime = Carbon::create(2025, 10, 30, 10, 00, 00, 'Asia/Kolkata');
        $endTime   = Carbon::create(2025, 11, 03, 18, 00, 00, 'Asia/Kolkata');

        if ($now->between($startTime, $endTime)) {
            // Editing period active: mark as draft
            $applications = NhidclRecruitmentApplications::all();

            foreach ($applications as $recordApplication) {
                if($recordApplication->action=="submit" && empty($recordApplication->display_time)){
                    $recordApplication->action = 'draft';
                    $recordApplication->display_time = $endTime;
                    $recordApplication->save();

                    // Log entry
                    NhidclRecruitmentApplicationsLogs::updateOrCreate(
                        ['nhidcl_recruitment_applications_id' => $recordApplication->id],
                        [
                            'ref_users_id' => $recordApplication->ref_users_id,
                            'status' => 'draft',
                            'comment' => 'Auto granted edit permission via system cron',
                            'upload_file' => null,
                            'upload_file_path' => null,
                            'created_by' => 1, // system/admin id
                        ]
                    );

                    // Send email
                    try {
                        $recipient = User::find($recordApplication->ref_users_id);
                        if ($recipient) {
                            $applicationId = "NHIDCL/" . date('Y') . "/" . $recordApplication->nhidcl_recruitment_posts_id . "/" . $recordApplication->ref_users_id;
                            //$myEmail = 'recruitment.nhidcl@nhidcl.com';
                            $myEmail = 'mayank.raghav@velocis.co.in';

                            Mail::send('emails.application_update', [
                                'user' => $recipient,
                                'applicationId' => $applicationId,
                            ], function ($message) use ($recipient, $myEmail) {
                                $message->to($recipient->email)
                                    ->cc($myEmail)
                                    ->subject("Application Edit Permission - NHIDCL Recruitment Portal");
                            });
                        }
                    } catch (\Exception $e) {
                        Log::error("Mail error for application ID {$recordApplication->id}: " . $e->getMessage());
                    }
                }
            }

            $this->info("All applications set to 'draft' and mails sent successfully.");

        } elseif ($now->greaterThan($endTime)) {
            // After 03/11/2025 6:00 PM — disable editing
            $applications = NhidclRecruitmentApplications::where('action', 'draft')->get();

            foreach ($applications as $recordApplication) {
                if (!empty($recordApplication->place_of_application) && $recordApplication->action === "draft") {

                    // Update application status
                    $recordApplication->action = 'submit';
                    $recordApplication->save();

                    // Default values (for cron/system runs)
                    $ipAddress = request()->ip() ?? 'system-cron';
                    $latitude  = null;
                    $longitude = null;

                    // 🛰️ Try to get geolocation if IP exists
                    if ($ipAddress !== 'system-cron' && $ipAddress !== '127.0.0.1') {
                        try {
                            // Use a simple public API like ip-api.com
                            $response = @file_get_contents("http://ip-api.com/json/{$ipAddress}");
                            $geoData = json_decode($response, true);

                            if (!empty($geoData) && $geoData['status'] === 'success') {
                                $latitude = $geoData['lat'];
                                $longitude = $geoData['lon'];
                            }
                        } catch (\Exception $e) {
                            Log::warning("Failed to fetch geolocation for IP {$ipAddress}: " . $e->getMessage());
                        }
                    }
                    
                    // Add log entry
                    NhidclRecruitmentApplicationsLogs::updateOrCreate(
                        [
                            'nhidcl_recruitment_applications_id' => $recordApplication->id,
                        ],
                        [
                            'ip_address' => $ipAddress, // or 'system-cron' if run from scheduler
                            'latitude'   => $latitude,
                            'longitude'  => $longitude,
                            'datetime'   => Carbon::now(),
                            'status'     => 'submit',
                            'comment'    => 'Editing period ended. Draft application status changed to submitted by system.',
                            'updated_by' => 1,
                        ]
                    );
                }
            }
            $this->info("Editing period ended. All draft applications status submitted.");
        } else {
            $this->info("Not within active edit period. No action taken.");
        }
    }
}
