<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Services\DocumentService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DocumentController extends Controller
{
    private DocumentService $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index(): AnonymousResourceCollection
    {
        $documents = $this->documentService->getDocuments();

        return DocumentResource::collection($documents);
    }

    public function create(string $type, CreateDocumentRequest $request): DocumentResource
    {
        if ($type === 'reservation') {
            $document = $this->documentService->createReservationDocument($request);
        } else {
            $document = $this->documentService->createShipmentDocument($request);
        }

        return new DocumentResource($document);
    }
}
