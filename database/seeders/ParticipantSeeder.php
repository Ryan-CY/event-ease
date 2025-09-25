<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $events = Event::all();

        foreach ($users as $user) {
            $participateEvent = $events->random(rand(1, 3));

            foreach ($participateEvent as $event) {
                Participant::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id
                ]);
            }
        }
    }
}
