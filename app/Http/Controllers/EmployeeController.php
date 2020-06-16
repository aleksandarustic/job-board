<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
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
        $employees = Employee::orderBy('created_at', 'desc')->with('employee_company')->paginate(10);
        return view('employees.index')->with('employees',$employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::pluck('name', 'id');;
        return view('employees.create')->with('companies',$companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'firstname' => 'required|string|max:125',
            'lastname' => 'required|string|max:125',
            'phone' => 'nullable|string|max:125',
            'email'=> 'nullable|email|max:125|unique:employees',
            'company'=> 'required|integer|exists:companies,id',
        ]);

        $employee = new Employee();
        $employee->firstname = $request->input('firstname');
        $employee->lastname = $request->input('lastname');
        $employee->email = $request->input('email');
        $employee->phone =$request->input('phone');
        $employee->company = $request->input('company');

        if($employee->save()){

            return redirect()->route('employee.index')->with('message','Employee has been successfuly created');
        }
        else{
            return redirect()->route('employee.create');

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id', $id)->with('employee_company')->firstOrFail();
        return view('employees.show')->with('employee',$employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $companies = Company::pluck('name', 'id');;
        return view('employees.edit')->withEmployee($employee)->withCompanies($companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $employee = Employee::findOrFail($id);

        $this->validate($request,[
            'firstname' => 'required|string|max:125',
            'lastname' => 'required|string|max:125',
            'phone' => 'nullable|string|max:125',
            'email'=> 'nullable|email|max:125|unique:employees,email,'.$employee->id,
            'company'=> 'required|integer|exists:companies,id',
        ]);
        
        if( $employee->update($request->input())){

            return redirect()->route('employee.index')->with('message','Employee has been successfuly updated');
        }
        else{
            return redirect()->route('employee.create');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('message','Employee has been successfuly deleted');
    }
}
