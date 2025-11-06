<?php

namespace App\Http\Controllers\Auth; // This should be the very first line

use App\Http\Controllers\Controller; // Use statements come after the namespace
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecruitmentNotificationMail;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{

    public function recruitmentNotification()
    {
        try {
            $subject = 'Advance intimation regarding edit option to review and update online applications for the Post of Deputy Manager (Tech.)';
            $message = 'IMPORTANT NOTICE: The edit option to all the applicants for the post of Deputy Manager (Tech.) will be available from 6:00 PM of 31.10.2025 to 6:00 PM of 03.11.2025 for 72 hours. Click here for more details.​';

            $count = 0;

            // Increase execution time slightly (optional safety)
            ini_set('max_execution_time', 2400); // 5 minutes

            // Process in small batches to prevent timeout
            User::role('Recruitment User')
                ->orderBy('id', 'DESC')
                ->chunk(50, function ($users) use ($subject, $message, &$count) {
                    foreach ($users as $user) {
                        try {
                            // Send mail synchronously (no queue)
                            Mail::to($user->email)
                                ->send(new RecruitmentNotificationMail($subject, $message));
                            $count++;
                        } catch (\Exception $ex) {
                            Log::error("Mail failed for {$user->email}: " . $ex->getMessage());
                        }
                    }
                });
            Log::info("Emails sent successfully to {$count} users.");
            return response()->json([
                'status' => true,
                'message' => "Emails sent successfully to {$count} users.",
            ]);

        } catch (\Exception $e) {
            Log::error("Recruitment notification error: " . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to send notification emails.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



}
