<?php

namespace App\Models;

use App\Http\Enums\TableLocation;
use App\Http\Enums\TableStatus;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'name',
        'capacity',
        'location',
        'status',
        'description',
    ];

    protected $casts = [
        'status' => TableStatus::class,
        'location' => TableLocation::class
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
