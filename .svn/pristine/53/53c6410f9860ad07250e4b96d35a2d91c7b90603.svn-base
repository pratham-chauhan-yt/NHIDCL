<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TaskManagement\TaskDetail;
use App\Models\TaskManagement\ModuleActivity;
use App\Enums\TaskStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GenerateRecurringTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public $signature = 'tasks:generate-recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Log::info('Recurring task command started.');
        $templates = TaskDetail::where('is_recurring', true)
            ->whereNull('parent_task_id')
            ->get();

        //Log::info("Found " . $templates->count() . " recurring templates.");
        foreach ($templates as $template) {
            //Log::info("Checking template task ID: {$template->id}");
            if ($template->status === TaskStatus::Completed) {
                //Log::info("Template {$template->id} is completed. Skipping.");
                continue;
            }

            $latestTask = TaskDetail::where(function ($query) use ($template) {
                    $query->where('id', $template->id)
                        ->orWhere('parent_task_id', $template->id);
                })
                ->orderByDesc('due_date')
                ->first();

            if (!$latestTask) {
                //Log::info("No latest task found for template {$template->id}. Skipping.");
                continue;
            }

            // if ($latestTask->status !== TaskStatus::InProgress) {
            //     Log::info("Latest task for template {$template->id} is not completed. Skipping.");
            //     continue;
            // }

            $lastDueDate = Carbon::parse($latestTask->due_date);
            $nextDueDate = match ($template->frequency) {
                'Daily' => $lastDueDate->addDay(),
                'Weekly' => $lastDueDate->addWeek(),
                'Monthly' => $lastDueDate->addMonth(),
                default => null,
            };

            //Log::info("Next due date for task {$template->id}: " . ($nextDueDate?->toDateString() ?? 'null'));
            if ($nextDueDate && $nextDueDate->lte(now())) {
                $alreadyExists = TaskDetail::where('parent_task_id', $template->id)
                    ->whereDate('due_date', $nextDueDate->toDateString())
                    ->exists();

                if ($alreadyExists) {
                    //Log::info("Recurring task for {$template->id} on {$nextDueDate->toDateString()} already exists. Skipping.");
                    continue;
                }

                TaskDetail::create(attributes: [
                    "task_id" => "MDTASK/".rand(11111,99999),
                    'task_name' => $template->task_name,
                    'ref_bucket_id' => $template->ref_bucket_id,
                    'division' => $template->division,
                    'ref_priority_id' => $template->ref_priority_id,
                    'start_date' => now()->toDateString(),
                    'due_date' => $nextDueDate->toDateString(),
                    'ref_task_repeat_id' => $template->ref_task_repeat_id,
                    'frequency' => $template->frequency,
                    'note' => $template->note,
                    'ref_task_source_id' => $template->ref_task_source_id,
                    'assigned_to' => $template->assigned_to,
                    'upload_attachment' => $template->upload_attachment,
                    'other_task_source' => $template->other_task_source,
                    'is_recurring' => true,
                    'parent_task_id' => $template->id,
                    'created_by' => $template->created_by,
                    'created_at' => now()
                ]);

                ModuleActivity::create([
                    "module" => "md task",
                    "ref_users_id" => $template->assigned_to,
                    "description" => "Created new recurring task for template {$template->id} on {$nextDueDate->toDateString()}.",
                    "ip_address" => $template->ip_address,
                    "event" => "created",
                    "created_by" => $template->created_by,
                ]);
                //Log::info("Created new recurring task for template {$template->id} on {$nextDueDate->toDateString()}.");
            }
        }
        //Log::info('Recurring task command completed.');
    }
}