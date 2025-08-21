<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use App\Notifications\RappelExpirationReservation;
use Illuminate\Console\Command;

class EnvoyerNotificationExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:envoyer-notification-expiration';

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
    $maintenant = now();
    $seuil = $maintenant->copy()->addHour(); // 1h avant

    $reservations = Reservation::where('statut', 'en attente')
        ->where('notification_envoyee', false)
        ->where('date_fin', '<=', $seuil)
        ->where('date_fin', '>', $maintenant)
        ->get();

    foreach ($reservations as $reservation) {
        $client = $reservation->client;

        if ($client) {
            $client->notify(new RappelExpirationReservation($reservation));

            $reservation->notification_envoyee = true;
            $reservation->save();
        }
    }
}

}
