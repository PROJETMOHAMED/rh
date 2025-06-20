<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = [
        'url',
        'file_id',
        'file_type',
    ];
    public function filleable()
    {
        return $this->morphTo();
    }
    static public function getData()
    {
        
    }
}
