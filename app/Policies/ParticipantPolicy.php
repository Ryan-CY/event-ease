<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ParticipantPolicy
{
    /**
     * Determine whether the user can view any models.(for index)
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.(for show)
     */
    public function view(?User $user, Participant $participant): bool
    {
        return true;
    }

    /**
     * Determine whether the user can join event.
     */
    public function create(User $user, Event $event): Response|bool
    {
        if ($user->id === $event->user_id) {
            return Response::deny('You cannot join your own event.');
        }

        $existingParticipant = $event->participants()->where('user_id', $user->id)->exists();
        if ($existingParticipant) {
            return Response::deny('You have already joined this event.');
        }

        $participantNumber = $event->participants_count;
        if ($participantNumber >= $event->capacity) {
            return Response::deny('Event is full.');
        }

        if (now()->greaterThanOrEqualTo($event->start)) {
            return Response::deny('Event has already started.');
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Participant $participant): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Participant $participant): Response|bool
    {
        if ($user->id !== $participant->user_id && 
            $user->id !== $participant->event->user_id) {
            return Response::deny('You are not authorized to do withdraw this participant.');
        }

        if (now()->greaterThanOrEqualTo($participant->event->start)) {
            return Response::deny('Event has already started, cannot withdraw.');
        }

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Participant $participant): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Participant $participant): bool
    {
        return false;
    }
}
