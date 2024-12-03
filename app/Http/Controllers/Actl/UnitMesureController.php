<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnitMesure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class UnitMesureController extends Controller
{
    public function UnitMesureAll(){
        $unitMesures = UnitMesure::latest()->get();
        return view('backend.unitMesure.unitMesure_all', compact('unitMesures'));
    }

    public function UnitMesureAdd(){
        return view('backend.unitMesure.unitMesure_add');
    }

    public function UnitMesureStore(Request $request){
        UnitMesure::insert([
            'unitMesure' => $request->unitMesure,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'UnitMesure added successfully!', 
            'alert-type' => 'success'
        );

        return redirect()->route('unitMesure.all')->with($notification);
    }


    public function UnitMesureEdit($id){
        $unitMesure = UnitMesure::findOrFail($id);
        return view('backend.unitMesure.unitMesure_edit', compact('unitMesure'));

    }

    public function UnitMesureUpdate(Request $request){
        $unitMesure_id=$request->id;

        UnitMesure::findOrFail($unitMesure_id)->update([
            'unitMesure' => $request->unitMesure,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'UnitMesure updated successfully!', 
            'alert-type' => 'success'
        );
        return redirect()->route('unitMesure.all')->with($notification);
    }


    public function UnitMesureDelete($id){
        UnitMesure::findOrFail($id)->delete();
        $notification = array(
            'message' => 'UnitMesure deleted successfully!', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    
    }
}
