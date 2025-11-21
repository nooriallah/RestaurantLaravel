<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $fillable = ["full_name", "email", "contact_number", "number_of_guests", "reservation_time", "table_id","status", "user_id", "special_requests"];


    public function table()
    {
        return $this->belongsTo(Table::class);
    }

}

