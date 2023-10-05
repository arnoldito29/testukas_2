<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'name',
        'type',
        'size',
    ];

    public function reservations(): MorphToMany
    {
        return $this->morphedByMany(Reservation::class, 'model', 'shipment_reservation');
    }

    public function shipments(): MorphToMany
    {
        return $this->morphedByMany(Shipment::class, 'model', 'shipment_reservation');
    }
}
