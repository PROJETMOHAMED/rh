<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        "employee_id",
        "status",
        "time",
        "date",
        "reason",
    ];

    public function Files()
    {
        return $this->morphOne(File::class, 'file');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    static public function getData()
    {
    }
}
