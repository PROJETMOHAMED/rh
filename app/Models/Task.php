<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'employee_id',
        'name',
        'date_debut',
        'date_fin',
        'status',
        'details',
        'link',
    ];

    // Define relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    static public function getData(Request $request)
    {
        $data = self::select("tasks.*");

        // Filter by date if 'date' parameter exists in the request
        if ($request->date) {
            $date = $request->get('date');
            // Apply the filter for tasks that fall within the specified date range
            $data = $data->where('date_debut', '<=', $date)
                ->where('date_fin', '>=', $date);
        }

        if ($request->employee_name) {
            $search = $request->get('employee_name');
            // Use whereHas to filter tasks based on related employee's firstname or last_name
            $data = $data->whereHas('employee', function ($query) use ($search) {
                $query->where('firstname', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

        // Return the filtered tasks, sorted by the latest tasks first, paginated with 10 tasks per page
        return $data->latest()->paginate(10);
    }
}
