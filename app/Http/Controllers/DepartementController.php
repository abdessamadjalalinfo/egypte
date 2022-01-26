<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\SubDepartement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function departement()
    {
        $departements = Departement::all();
        return view('departement', ['departements' => $departements]);
    }

    public function edit_departement(Request $request)
    {
        $departement = Departement::find($request->id);
        $departement->name = $request->name;
        $departement->save();


        return back()->with('success', 'Departement edited successfully!');
    }
    public function edit_subdepartement(Request $request)
    {
        $departement = SubDepartement::find($request->id);
        $departement->name = $request->name;
        $departement->departement_id = $request->departement_id;
        $departement->save();


        return back()->with('success', 'SubDepartement edited successfully!');
    }

    public function storedepartement(Request $req)
    {
        $departement = new Departement();
        $departement->name = $req->name;
        $departement->save();
        return back()->with('success', 'Departement created successfully!');
    }

    public function storesubdepartement(Request $req)
    {
        $subdepartement = new SubDepartement();
        $subdepartement->name = $req->name;
        $subdepartement->departement_id = $req->departement;
        $subdepartement->save();
        return back()->with('success', 'Sub Departement created successfully!');
    }
    public function sub_departement()
    {
        $subdepartements = SubDepartement::all();
        $departements = Departement::all();
        return view('sub_departement', ['subdepartements' => $subdepartements, 'departements' => $departements]);
    }

    public function getsubdepartements(Request $request)
    {
        $sub = SubDepartement::where('departement_id', $request->departement)->get();
        return $sub;
    }
    public function gettype2(Request $request)
    {
        if ($request->type1 == "permissions") {
            return ['Cash Ex', 'Receive cash'];
        }
        return ['General', 'Purchasing', 'Cheques', 'Store expenses'];
    }
}
