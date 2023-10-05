<?php

namespace App\ModelFactories;

use App\Enums\MimeTypeEnum;
use App\Models\Document;
use App\Models\Reservation;
use App\Models\Shipment;

class DocumentFactory
{
    public function create(string $name, MimeTypeEnum $mimeType, int $size): Document
    {
        $document = new Document();
        $document->name = $name;
        $document->mime_type = $mimeType->value;
        $document->size = $size;

        return $document;
    }

    public function crateDocumentWithShipment(string $name, MimeTypeEnum $mimeType, int $size, string $shipmentName): Document
    {
        $document = $this->create($name, $mimeType, $size);

        $shipment = new Shipment();
        $shipment->name = $shipmentName;

        $document->shipments[] = $shipment;

        return  $document;
    }

    public function crateDocumentWithReservation(string $name, MimeTypeEnum $mimeType, int $size, string $reservationName): Document
    {
        $document = $this->create($name, $mimeType, $size);

        $reservation = new Reservation();
        $reservation->name = $reservationName;

        $document->reservations[] = $reservation;

        return  $document;
    }
}
