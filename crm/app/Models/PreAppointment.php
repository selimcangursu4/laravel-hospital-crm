<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreAppointment extends Model
{
    protected $table = 'pre_appointments';

      protected $fillable = [
        'lead_id',
        'service_id',
        'appointment_datetime',
        'note',
        'status_id'
    ];
}
