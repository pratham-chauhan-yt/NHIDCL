<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Grievance;
use App\Models\User;
use App\Models\GrievanceLog;

class EscalateGrievances extends Command
{
    protected $signature = 'grievances:escalate';
    protected $description = 'Escalate pending grievances based on SLA';

    public function handle()
    {
        $this->info('Starting escalation check...');
        $pending = Grievance::whereIn('status', ['open','under_review'])->get();

        foreach ($pending as $g) {
            $lastUpdate = $g->updated_at;
            $days = now()->diffInDays($lastUpdate);

            // Simple SLA rules:
            // level 0 -> after 7 days escalate to ICC
            // level 1 -> after 10 days escalate to MD

            if ($g->escalation_level == 0 && $days >= 7) {
                $icc = User::role('ICC')->first();
                if ($icc) {
                    $g->assigned_to = $icc->id;
                    $g->escalation_level = 1;
                    $g->save();
                    GrievanceLog::create(['grievance_id' => $g->id, 'action' => 'escalated', 'comment' => 'Escalated to ICC']);
                    $icc->notify(new \App\Notifications\GrievanceAssigned($g));
                }
            } elseif ($g->escalation_level == 1 && $days >= 10) {
                $md = User::role('MD')->first();
                if ($md) {
                    $g->assigned_to = $md->id;
                    $g->escalation_level = 2;
                    $g->save();
                    GrievanceLog::create(['grievance_id' => $g->id, 'action' => 'escalated', 'comment' => 'Escalated to MD']);
                    $md->notify(new \App\Notifications\GrievanceAssigned($g));
                }
            }
        }
        $this->info('Escalation check completed.');
    }
}