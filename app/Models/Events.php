<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'events';

    // Define the primary key column
    protected $primaryKey = 'event_id';

    // Disable timestamps
    public $timestamps = false;

    // Define the fillable columns
    protected $fillable = [
        'event_id',
        'event_name',
        'type',
        'half_day_type',
        'eventdate',
    ];

    // Define the cast types
    protected $casts = [
        'event_id' => 'integer',
        'eventdate' => 'date',
    ];
}
