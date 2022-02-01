<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Document;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function addfile()
    {
        if (Auth::user()->type == "admin" || Auth::user()->type == "editor") {
            $departements = Departement::all();
            return view('add_file', ['departements' => $departements]);
        }
        return view('index');
    }
    public function storedocument(Request $request)
    {

        // dd($request);
        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $document = new Document();
                $document->target = $request->target;
                $document->type1 = $request->type1;
                $document->type2 = $request->type2;
                $document->file_id = $request->file_id;
                $name = $request->target . time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('files'), $name);
                $document->path = $name;
                $document->save();
            }
        }


        return back()->with('success', 'Document created successfully!');
    }
    public function storefile(Request $request)
    {

        $file = new File();
        $file->target = $request->target;
        $file->user_id = $request->user_id;
        $file->scanning_date = date("Y-m-d");
        $file->number_of_pages = $request->nb_pages;

        $file->vendor_name = $request->vendor_name;
        $file->transaction_number = $request->transaction_number;
        $file->date_of_docs = $request->date_of_docs;

        $file->departement_id = $request->departement;
        $file->sub_departement_id = $request->sub_departement;
        $file->save();
        return redirect()->route('addnewdocumentforfile', $file->id)->with('success', 'File created successfully! Please add document');
    }
    public function editfile(Request $request)
    {
        $file =  File::find($request->id);
        $file->target = $request->target;
     
        $file->number_of_pages = $request->nb_pages;
        $file->departement_id = $request->departement;

        $file->vendor_name = $request->vendor_name;
        $file->transaction_number = $request->transaction_number;
        $file->date_of_docs = $request->date_of_docs;



        $file->sub_departement_id = $request->sub_departement;
        $file->save();
        return redirect()->back()->with('success', 'File updated successfully! Please add document');
    }
    public function file()
    {


        $files = File::paginate(20);;
        return view('files', ['files' => $files]);
    }
    public function showfile($id)
    {
        $file = File::find($id);
        //dd($file);
        return view('onefile', ['file' => $file]);
    }
    public function showdocuments()
    {
        $documemnts = Document::Paginate(20);
        $files = File::all();
        return view('showdocuments', ['documemnts' => $documemnts, 'files' => $files]);
    }
    public function searchdocuments(Request $req)
    {

        $documemnts = Document::where('file_id', $req->file_id)->orWhere('target', $req->target)->orWhere('type1', $req->type1)->Paginate(20);
        $files = File::all();
        return view('showdocuments', ['documemnts' => $documemnts, 'files' => $files]);
    }
    public function addnewdocument()
    {
        $files = File::all();
        return view('addnewdocument', ['files' => $files]);
    }
    public function addnewdocumentforfile($id)
    {
        $file = File::find($id);
        return view('adddocumentforfile', ['file' => $file]);
    }

    public function deletedocument($id)
    {
        $doc = Document::find($id);
        $doc->delete();
        return redirect()->back();
    }
    public function updatedocument(Request $req)
    {
        $document = Document::find($req->id);
        $document->target = $req->target;
        $document->type1 = $req->type1;
        $document->type2 = $req->type2;
        $document->file_id = $req->file_id;
        $document->save();
        return redirect()->back()->with('success', 'Document  updated successfully! ');;
    }
    public function searchfiles()

    {
        $departements = Departement::all();
        return view('searchfiles', ['departements' => $departements]);
    }
    public function search(Request $req)
    {

        $files = File::select('*');
        if ($req->filled('target')) {
            $files->where('target', $req->target);
        }
        if ($req->filled('scanning_date')) {
            $files->where('scanning_date', $req->scanning_date);
        }
        if ($req->filled('nb_pages')) {
            $files->where('number_of_pages', $req->nb_pages);
        }
        if ($req->filled('departement')) {
            $files->where('departement_id', $req->departement);
        }
        if ($req->filled('user_id')) {
            $files->where('user_id', $req->user_id);
        }

        if ($req->filled('vendor_name')) {
            $files->where('vendor_name', $req->vendor_name);
        }

        if ($req->filled('transaction_number')) {
            $files->where('transaction_number', $req->transaction_number);
        }


        //dd($files);

        return view('files', ['files' => $files->paginate(10)]);
    }

    public function deleteMultiple(Request $request)
    {

        $ids = $request->ids;

        Document::whereIn('id', explode(",", $ids))->delete();

        return response()->json(['status' => true, 'message' => "Category deleted successfully."]);
    }
}
