<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = ['student_id', 'eventid'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'eventid',
        'timein_am',
        'timeout_am',
        'timein_pm',
        'timeout_pm'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function event()
    {
        return $this->belongsTo(Events::class, 'eventid');
    }
}
