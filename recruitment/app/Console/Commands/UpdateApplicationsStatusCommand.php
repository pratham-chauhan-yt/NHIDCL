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
        $startTime = Carbon::create(2025, 10, 31, 18, 00, 00, 'Asia/Kolkata');
        $endTime   = Carbon::create(2025, 11, 03, 18, 00, 00, 'Asia/Kolkata');

        // Extend script execution time for safety (optional)
        ini_set('max_execution_time', 2400); // 40 minutes max

        if ($now->between($startTime, $endTime)) {
            // Editing period active — move to draft
            $this->info("Editing window active. Updating submitted applications to draft...");

            NhidclRecruitmentApplications::where('action', 'submit')
                ->whereNull('display_time')
                ->orderBy('id')
                ->chunkById(100, function ($applications) use ($endTime) {
                    foreach ($applications as $recordApplication) {
                        try {
                            $recordApplication->action = 'draft';
                            $recordApplication->display_time = $endTime;
                            $recordApplication->save();

                            // Log the status update
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

                            // Send notification mail
                            $recipient = User::find($recordApplication->ref_users_id);
                            if ($recipient) {
                                $applicationId = "NHIDCL/" . date('Y') . "/" . $recordApplication->nhidcl_recruitment_posts_id . "/" . $recordApplication->ref_users_id;
                                $myEmail = 'recruitment.nhidcl@nhidcl.com';
                                //$myEmail = 'mayank.raghav@velocis.co.in';

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
                            Log::error("Draft update/mail error for application ID {$recordApplication->id}: " . $e->getMessage());
                        }
                    }
                });

            $this->info("All applicable applications set to 'draft' and mails sent successfully.");

        } elseif ($now->greaterThan($endTime)) {
            // After 03/11/2025 6:00 PM — disable editing
            $this->info("Editing window ended. Submitting all draft applications...");

            NhidclRecruitmentApplications::where('action', 'draft')
                ->orderBy('id')
                ->chunkById(100, function ($applications) {
                    foreach ($applications as $recordApplication) {
                        try {
                            $userdata = User::find($recordApplication->ref_users_id);

                            if (!empty($recordApplication->place_of_application) && $recordApplication->action === "draft") {
                                $recordApplication->action = 'submit';
                                $recordApplication->save();

                                // Collect geo/IP info
                                $ipAddress = request()->ip() ?? 'system-cron';
                                $latitude = null;
                                $longitude = null;

                                if ($ipAddress !== 'system-cron' && $ipAddress !== '127.0.0.1') {
                                    try {
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

                                // Log submission
                                NhidclRecruitmentApplicationsLogs::updateOrCreate(
                                    ['nhidcl_recruitment_applications_id' => $recordApplication->id],
                                    [
                                        'name'       => $userdata->name ?? '',
                                        'ip_address' => $ipAddress,
                                        'latitude'   => $latitude,
                                        'longitude'  => $longitude,
                                        'datetime'   => Carbon::now(),
                                        'status'     => 'submit',
                                        'comment'    => 'Editing period ended. Draft application status changed to submitted by system.',
                                        'updated_by' => 1,
                                    ]
                                );
                            }
                        } catch (\Exception $e) {
                            Log::error("Submit update error for application ID {$recordApplication->id}: " . $e->getMessage());
                        }
                    }
                });

            $this->info("All draft applications have been submitted successfully.");

        } else {
            $this->info("Not within active edit period. No action taken.");
        }
    }

}
