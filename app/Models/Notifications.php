<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'idnotification';
    public $timestamps = false;

    protected $fillable = [
        'notification',
        'created_at',
    ];

    public function notificationStudents()
    {
        return $this->hasMany(NotificationStudent::class, 'notification_id', 'idnotification');
    }
}
