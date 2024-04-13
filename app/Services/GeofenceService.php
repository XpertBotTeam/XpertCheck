<?php

namespace App\Services;

use App\Models\Geofence;
use Illuminate\Database\Eloquent\Builder;

class GeofenceService
{
    /**
     * Check if given latitude and longitude are within any geofence.
     *
     * @param float $latitude
     * @param float $longitude
     * @return bool
     */
    public function isWithinGeofence(float $latitude, float $longitude): bool
    {
        return Geofence::where(function (Builder $query) use ($latitude, $longitude) {
            $query->whereRaw('? >= LEAST(latitude1, latitude2, latitude3, latitude4)', [$latitude])
                  ->whereRaw('? <= GREATEST(latitude1, latitude2, latitude3, latitude4)', [$latitude])
                  ->whereRaw('? >= LEAST(longitude1, longitude2, longitude3, longitude4)', [$longitude])
                  ->whereRaw('? <= GREATEST(longitude1, longitude2, longitude3, longitude4)', [$longitude]);
        })->exists();
    }
}
