<?php

namespace App\Http\Controllers;

use App\Models\WorkHour2;
use App\Models\Employee2;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class WorkHour2Controller extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = WorkHour2::with('employee');
        
        if ($search) {
            $query->whereHas('employee', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
            })
            ->orWhere('work_date', 'like', "%{$search}%")
            ->orWhere('start_time', 'like', "%{$search}%")
            ->orWhere('end_time', 'like', "%{$search}%");
        }
        
        $workHours = $query->paginate(40); 
        return view('crm2.workhours.index', compact('workHours'));
    }

    public function create()
    {
        $employees = Employee2::all();
        return view('crm2.workhours.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees2,id',
            'work_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $exists = WorkHour2::where('employee_id', $data['employee_id'])
            ->where('work_date', $data['work_date'])
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['work_date' => 'Запись для этого сотрудника и даты уже существует'])
                ->withInput();
        }

        try {
            WorkHour2::create($data);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('crm2.workhours.index')
                    ->with('warning', 'Запись для этого сотрудника и даты уже существует (ошибка игнорирована).');
            }
            throw $e;
        }

        return redirect()->route('crm2.workhours.index')->with('success', 'Рабочие часы добавлены');
    }

    public function show(WorkHour2 $workhour)
    {
        $workhour->load('employee');
        return view('crm2.workhours.show', compact('workhour'));
    }

    public function edit(WorkHour2 $workhour)
    {
        $employees = Employee2::all();
        return view('crm2.workhours.edit', compact('workhour', 'employees'));
    }

    public function update(Request $request, WorkHour2 $workhour)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees2,id',
            'work_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $exists = WorkHour2::where('employee_id', $data['employee_id'])
            ->where('work_date', $data['work_date'])
            ->where('id', '!=', $workhour->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['work_date' => 'Запись для этого сотрудника и даты уже существует'])
                ->withInput();
        }

        $workhour->update($data);

        return redirect()->route('crm2.workhours.index')->with('success', 'Рабочие часы обновлены');
    }

    public function destroy(WorkHour2 $workhour)
    {
        $workhour->delete();
        return redirect()->route('crm2.workhours.index')->with('success', 'Запись успешно удалена.');
    }
}