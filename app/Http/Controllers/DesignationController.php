<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Designation;
use App\Http\Requests\DesignationRequest;
use Auth;

class DesignationController extends Controller
{
    public function designation()
    {
        $des = Designation::paginate(10);

        return view('hr.designation', compact('des'));
    }

    public function saveDesignation(DesignationRequest $request)
    {
        DB::beginTransaction();
        
        try {

            // Check if designation already exists
            $existingDesignation = Designation::where('designation', $request->designation)
                                                ->first();

             if ($existingDesignation) {
                DB::rollBack();
                return back()->with('error', 'Designation already exists.');
            }

            $des = new Designation;
            $des->designation       = $request->designation;
            $des->save();
            DB::commit();
    
            return redirect()->route('designationlist');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to create user.');
        }

    }

    public function updateDesignation(Request $request)
    {
        DB::beginTransaction();

        // Check if another designation has the desgination name
        $existingDesignation = Designation::where('designation', $request->designation)
                                        ->where('id', '!=', $request->id)
                                        ->first();

        if ($existingDesignation) {
            DB::rollBack();
            return back()->with('error', 'Another designation with the same name already exists.');
        }

        $des = [
            'designation'       => $request->designation,
        ];

        Designation::where('id', $request->id)->update($des);
        DB::commit();
        return redirect()->back();
    }

    public function deleteDesignation(Request $request)
    {
        $des = Designation::find($request->id);

        if(!$des) {
            return redirect()->back()->with('error', 'Designation not found.');
        }

        $des->delete();
        return redirect()->back();
    }
}
