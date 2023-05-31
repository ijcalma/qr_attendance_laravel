<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    use HasFactory;

    protected $table = 'event_attendance';

    protected $primaryKey = null; // Since the table doesn't have a primary key column

    public $incrementing = false; // Disable auto-incrementing primary key assumption

    protected $fillable = [
        'studentid',
        'eventid',
        'timein_no',
        'timeout_no',
        'event_total_timein',
        'event_total_timeout',
        'event_total_absents',
    ];

    public function event()
    {
        return $this->belongsTo(Events::class, 'eventid');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentid');
    }
}
