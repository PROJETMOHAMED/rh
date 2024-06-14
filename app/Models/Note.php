<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable = [
        "date",
        "description",
    ];
    public static $rules = [
        'date' => 'required|date',
        'description' => 'required|string',
    ];

    static public function getData(Request $request)
    {
        $data = self::select("notes.*");

        if ($request->date) {
            $date = $request->get('date');
            $data = $data->where('date', $date);
        }
        return $data->latest()->paginate(10);
    }
}
