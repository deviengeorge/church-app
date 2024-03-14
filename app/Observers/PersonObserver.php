<?php

namespace App\Observers;

use App\Enums\FamilyStatus;
use App\Models\Family;
use App\Models\Person;
use Illuminate\Support\Facades\Log;

class PersonObserver
{
    /**
     * Handle the Person "created" event.
     */
    public function created(Person $person): void
    {
        $this->checkFamilyDeath($person);
    }

    /**
     * Handle the Person "updated" event.
     */
    public function updated(Person $person): void
    {
        $this->checkFamilyDeath($person);
    }

    protected function checkFamilyDeath(Person $person)
    {
        if ($person->family()->exists()) {
            $family = $person->family;
            $members = $person->family->members();
            $isWholeFamilyDied = true;
            $members->each(function (Person $person) use (&$isWholeFamilyDied) {
                // Then this person is dead
                if ($person->date_of_death == null) {
                    $isWholeFamilyDied = false;
                    return false;
                } else {
                    $isWholeFamilyDied = true;
                    return true;
                }
            });

            // Change the family status to out of service for dying
            $family->status = $isWholeFamilyDied ? FamilyStatus::OUT_OFF_SERVICE_FOR_DYING : FamilyStatus::IN_SERVICE;
            $family->save();
        }
    }

    /**
     * Handle the Person "deleted" event.
     */
    public function deleted(Person $person): void
    {
        //
    }

    /**
     * Handle the Person "restored" event.
     */
    public function restored(Person $person): void
    {
        //
    }

    /**
     * Handle the Person "force deleted" event.
     */
    public function forceDeleted(Person $person): void
    {
        //
    }
}
