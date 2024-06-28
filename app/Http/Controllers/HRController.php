<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Models\Designation;
use App\Models\Department;
use Auth;

class HRController extends Controller
{
    public function employeeList()
    {
        $today = date('Ymd');
        $empIDs  = Employee::where('emp_id', 'like', $today.'%')->pluck('emp_id');
        do {
            $empID = $today . rand(10, 99);
        } while($empIDs->contains($empID));

        // Order employees by the latest data
        $employees = Employee::with('designationType')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        // $emp_ID = $empID;

        $empCnt         = Employee::count();
        $designations   = Designation::all();
        $departments    = Department::all();


        return view('hr.hr-employee', [
            'empID'         => $empID,
            'empCnt'        => $empCnt,
            'employees'     => $employees,
            'designations'  => $designations,
            'departments'   => $departments,
        ]);
    }

    public function saveEmployee(EmployeeRequest $request)
    {
        DB::beginTransaction();
        try{

            // Check if employee already exists by fname, lname, and emp_id
            $existingEmployee = Employee::where('fname', $request->fname)
                                        ->where('mname', $request->mname)
                                        ->where('lname', $request->lname)
                                        ->first();

             if ($existingEmployee) {
                DB::rollBack();
                return back()->with('error', 'Employee already exists.');
            }

            $image = $request->file('avatar');
            
            if ($image !== null)
            {
                $image_name = date('YmdHis') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/assets/images/employee'), $image_name);
            } else {

                $image_name = 'photo_defaults.png';
            }

            $emp = new Employee;
            $emp->emp_id            = $request->employeeId;
            $emp->fname             = $request->fname;
            $emp->mname             = $request->mname;
            $emp->lname             = $request->lname;
            $emp->email             = $request->email;
            $emp->des_type_id       = $request->designation;
            $emp->department_id     = $request->department;
            $emp->emp_type          = $request->empType;
            $emp->work_place        = $request->workPlace;
            $emp->emp_status        = $request->empStatus;
            $emp->avatar            = $image_name;
            $emp->save();
            DB::commit();

            return redirect()->route('employeelist');
        }catch(\Exception $e) {
            DB::rollback();
            return back()->with('error','Failed to save Employee');
        }
    }

    public function updateEmployee(Request $request)
    {
        DB::beginTransaction();

        // Check if another employee has the same fname, lname, and emp_id
        $existingEmployee = Employee::where('fname', $request->fname)
                                    ->where('mname', $request->mname)
                                    ->where('lname', $request->lname)
                                    ->where('id', '!=', $request->id)
                                    ->first();

        if ($existingEmployee) {
            DB::rollBack();
            return back()->with('error', 'Another employee with the same first name, middle name, and last name already exists.');
        }

        $image = $request->file('avatar');
            
        if ($image !== null)
        {
            $image_name = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/assets/images/employee'), $image_name);
        } else {

            $image_name = 'photo_defaults.png';
        }
        
        $employees = [

            'fname'         => $request->fname,
            'mname'         => $request->mname,
            'lname'         => $request->lname,
            'email'         => $request->email,
            'des_type_id'   => $request->designation,
            'department_id' => $request->department,
            'emp_type'      => $request->empType,
            'work_place'    => $request->workPlace,
            'emp_status'    => $request->empStatus,
            'avatar'        => $image_name,
        ];

        Employee::where('id',$request->id)->update($employees);
        DB::commit();
        return redirect()->back();
    }

    // public function deleteEmployee($id)
    // {
    //     $employee = Employee::find($id);
    
    //     if (!$employee) {
    //         return redirect()->back()->with('error', 'Employee not found.');
    //     }
    
    //     $employee->delete();
    //     return redirect()->back()->with('success', 'Employee deleted successfully.');
    // }

    public function deleteEmployee(Request $request)
    {
        $employee = Employee::find($request->id);
    
        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
    
        $employee->delete();
        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }
}
