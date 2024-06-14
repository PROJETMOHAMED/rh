<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function Employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function children()
    {
        return $this->hasMany(Type::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Type::class, 'parent_id', 'id');
    }

    static public function getData()
    {
        
    }
}
