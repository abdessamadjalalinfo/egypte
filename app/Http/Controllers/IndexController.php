<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->type == "admin") {

            $year = ['01','02','03','04','05','06','08','09','10','11','12'];
            $files = [];
            if($request->year){
            foreach ($year as $key => $value) {
                $files[] = File::where(DB::raw("Month(created_at)"),$value)->whereYear('created_at',$request->year)->count();
                $current=$request->year;
            }
        }
            else{
                foreach ($year as $key => $value) {
                    $files[] = File::where(DB::raw("Month(created_at)"),$value)->whereYear('created_at',2022)->count();
                    $current=2022;
                }

            }
            $userData = User::select(DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count');
                  
            return view('index',compact('userData'))->with('current',$current)->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('files',json_encode($files,JSON_NUMERIC_CHECK));
        }
        return redirect()->route('file');
    }
}
