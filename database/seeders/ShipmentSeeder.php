<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Shipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shipment::factory()
            ->count(20)
            ->create();
        $shipments = Shipment::all();

        Document::factory()
            ->count(20)
            ->create()
            ->each(function(Document $document) use ($shipments) {
                $shipment = rand(0, count($shipments) - 1);
                $document->shipments()->attach($shipments[$shipment]);
            });
    }
}
