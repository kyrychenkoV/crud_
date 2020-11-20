<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(5);

        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Employee::preparingData();

        return view('employees.create',compact( 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'salary' => 'required|integer',
            'department_id' => 'required|integer',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
            ->with('success','Pr    oduct created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit',['employee'=>$employee,'data' => Employee::preparingData()]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string',
            'salary' => 'required|integer',
            'department_id' => 'required|integer',
        ]);

        $employee->saveData($request->salary,$request->department_id ,$request->name);
        

        return redirect()->route('employees.index')
            ->with('success','Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success','Deleted successfully');
    }
}
