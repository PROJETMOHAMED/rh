<!-- resources/views/attendance/export.blade.php -->
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            @foreach ($dates as $date)
                <th>{{ $date }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->full_name }}</td>
                <td>{{ $employee->Departement->name }}</td>
                @foreach ($dates as $date)
                    @php
                        $date_picker = $date;
                        $check_attd = \App\Models\Attendance::query()
                            ->where('employee_id', $employee->id)
                            ->where('date', $date_picker)
                            ->first();
                    @endphp
                    <td
                        style="color: {{ $check_attd && $check_attd->status == 1
                            ? 'red'
                            : ($check_attd && $check_attd->status == 2
                                ? 'blue'
                                : 'black') }}">
                        @if ($check_attd)
                            @if ($check_attd->status == 1)
                                <span>
                                    Absent
                                </span>
                            @else
                                <span>
                                    retard
                                </span>
                            @endif
                        @else
                            <span>
                                presant
                            </span>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
