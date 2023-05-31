<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'student_info';

    // Define the primary key column
    protected $primaryKey = 'id';

    // Disable timestamps
    public $timestamps = false;

    // Define the fillable columns
    protected $fillable = [
        'id',
        'lastname',
        'firstname',
        'middlename',
        'extname',
        'course',
        'year',
        'block',
    ];
}
