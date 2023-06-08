<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notif_Students extends Model
{
    protected $table = 'notif_students';
    public $timestamps = false;

    protected $fillable = [
        'notif_id',
        'students_id',
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notif_id', 'idnotification');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'students_id', 'id');
    }
}
