<?php

namespace App\Services;

use App\Enums\MimeTypeEnum;
use App\Http\Requests\CreateDocumentRequest;
use App\ModelFactories\DocumentFactory;
use App\Models\Document;
use Illuminate\Support\Collection;

class DocumentService
{
    private Document $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }
    public function getDocuments(): Collection
    {
        return $this->document::with(['reservations', 'shipments'])->get();
    }

    public function createReservationDocument(CreateDocumentRequest $documentData): Document
    {
        $data = $this->getData($documentData);
        $factory = new DocumentFactory();
        $document = $factory->crateDocumentWithReservation(
            $data->get('file_name'),
            $data->get('file_mime_type'),
            $data->get('file_size'),
            $data->get('name')
        );

        $document->save();

        foreach ($document->reservations as $reservation) {
            $reservation->save();
            $document->reservations()->attach($reservation);
        }

        return $document;
    }

    private function getData(CreateDocumentRequest $documentData): Collection
    {
        $file = $documentData->file('file');
        $fileMimeType = $file->getMimeType();
        $selectedMimeType = '';

        foreach (MimeTypeEnum::cases() as $mimeType) {
            if ($mimeType->value == $fileMimeType) {
                $selectedMimeType = $mimeType;
                break;
            }
        }

        return collect([
            'file_name' => $file->getClientOriginalName(),
            'file_mime_type' => $selectedMimeType,
            'file_size' => $file->getSize(),
            'name' => $documentData->get('name'),
        ]);
    }

    public function createShipmentDocument(CreateDocumentRequest $documentData): Document
    {
        $data = $this->getData($documentData);
        $factory = new DocumentFactory();
        $document = $factory->crateDocumentWithShipment(
            $data->get('file_name'),
            $data->get('file_mime_type'),
            $data->get('file_size'),
            $data->get('name')
        );

        $document->save();

        foreach ($document->shipments as $shipment) {
            $shipment->save();
            $document->shipments()->attach($shipment);
        }

        return $document;
    }
}
