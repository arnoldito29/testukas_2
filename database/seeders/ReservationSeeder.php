<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Reservation;
use App\Models\Shipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::factory()
            ->count(20)
            ->create();
        $reservations = Reservation::all();

        Document::factory()
            ->count(20)
            ->create()
            ->each(function(Document $document) use ($reservations) {
                $reservation = rand(0, count($reservations) - 1);
                $document->reservations()->attach($reservations[$reservation]);
            });
    }
}
