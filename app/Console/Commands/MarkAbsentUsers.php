<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MarkAbsentUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-absent-users';

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
    $users = User::all();

    foreach ($users as $user) {
        $existingAttendance = $user->attendances()->whereDate('created_at', now())->first();

        if (!$existingAttendance && now()->hour >= 12) {
            // Mark user as absent if no check-in record exists by 12 PM
            $user->attendances()->create([
                'user_id' => $user->id,
                'date' => now(),
                'status' => 1, // Mark as absent
            ]);
        }
    }
}

}
