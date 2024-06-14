<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable = [
        'firstname',
        'last_name',
        'sexe',
        'email',
        'phone',
        'date_debut',
        'date_fin',
        'status',
        'piece_identite',
        'adresse',
        'departement_id',
        'type_id'
    ];

    public function getFullNameAttribute(): string
    {
        return $this->firstname .' ' . $this->last_name;;
    }
    protected $dates = [
        'date_debut',
        'date_fin',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function Tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function ContratType()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    public function Attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
