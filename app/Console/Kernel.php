<?php

namespace App\Console;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        if (!now()->isFriday() && !now()->isSaturday()) {
            $schedule
                ->call(function () {
                    $users = User::role(User::STUDENT)->with('studentLevelWithClasses')->get();
                    if ($users) {
                        foreach ($users as $single_user) {
                            $attendance = Attendance::where('user_id', $single_user->id)->where('class_id', $single_user->studentLevelWithClasses->class_id)
                                ->exists();
                            if (!$attendance) {
                                Attendance::create([
                                    'user_id' => $single_user->id,
                                    'teacher_id' => null,
                                    'class_id' => $single_user->studentLevelWithClasses->class_id,
                                    'date' => now(),
                                    'status' => Attendance::ABSENT
                                ]);
                            }
                        }
                    }
                })->daily();
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}