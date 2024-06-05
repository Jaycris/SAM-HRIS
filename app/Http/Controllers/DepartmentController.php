<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use Auth;


class DepartmentController extends Controller
{
    public function department()
    {
        $dep = Department::paginate(10);

        return view('hr.department',compact('dep'));
    }


    public function saveDepartment(DepartmentRequest $request)
    {
        DB::beginTransaction();

        try{

            //check if the department name already exist
            $existingDepartment =  Department::where('department', $request->department)
                                                ->first();

            if ($existingDepartment) {
                DB::rollback();
                return back()->with('error', 'Department already exist');
            }
            $dep =  new Department;
            $dep->department    = $request->department;
            $dep->save();
            DB::commit();
    
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to create user.');
        }
    }

    public function updateDepartment(Request $request)
    {
        DB::beginTransaction();

        //check if the department name already exist
        $existingDepartment =  Department::where('department', $request->department)
                                        ->first();

            if ($existingDepartment) {
                DB::rollback();
                return back()->with('error', 'Department already exist');
            }

        $dep = [
            'department'        => $request->department,
        ];

        Department::where('id', $request->id)->update($dep);
        DB::commit();
        return redirect()->back();
    }


    public function deleteDepartment(Request $request)
    {
        $dep = Department::find($request->id);

        if(!$dep)
        {
            return redirect()->back()->with('error','Department not found.');
        }

        $dep->delete();
        return redirect()->back();
    }
}
