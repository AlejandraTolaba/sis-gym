<?php

namespace App\Listeners;

use App\Event\InscriptionExpired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;

class ChangeStateInscription
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  InscriptionExpired  $event
     * @return void
     */
    public function handle(InscriptionExpired $event)
    {
        foreach ($event->inscriptions as $inscription){
            if ($inscription->expiration_date < Carbon::now()){
                $inscription->state ="inactiva";
                $inscription->save();
                // dd($inscription);
            }
        }

    }
}
