<?php

namespace App\Enum;

enum StatutReservation: string
{
    case RESERVE = 'reserve';
    case DISPONIBLE = 'disponible';

    public function voirStatut (): string
    {
        return match($this) {
            self::RESERVE => 'Réservation effectuée',
            self::DISPONIBLE => 'Disponible'
        };
    }
}