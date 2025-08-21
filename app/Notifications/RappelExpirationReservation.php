<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class RappelExpirationReservation extends Notification
{
    public function __construct(public $reservation) {}

    public function via($notifiable)
    {
        return ['database']; // Pas de mail, pas de broadcast
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Votre réservation de la voiture ' . $this->reservation->voiture->marque . ' ' . $this->reservation->voiture->modele . ' va bientôt expirer.',
            'reservation_id' => $this->reservation->id,
            'date_expiration' => $this->reservation->date_fin,
        ];
    }
}
