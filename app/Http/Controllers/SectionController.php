<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function __construct(){
        $this->middleware('permission:الاقسام', ['only' => ['index']]);
        $this->middleware('permission:اضافة قسم', ['only' => ['store']]);
        $this->middleware('permission:تعديل قسم', ['only' => ['update']]);
        $this->middleware('permission:حذف قسم', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections=Section::all();
        return view('sections.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validatedData=$request->validate([
            'section_name' => 'required|unique:sections|max:255',
            

        ],[
            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم موجود مسبقا',
            'section_name.max' =>'اسم القسم يجب الا يزيد عن 255 حرف',
        ]);
        


             Section::create([
                'section_name' => $request->section_name,
              'description' => $request->description,
                 'created_by' => Auth::user()->name,
             ]);
            session()->flash('Add', 'تمت الاضافة بنجاح');
            return redirect('/sections');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id=$request->id;
       
        $this->validate($request,[
            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[
            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم موجود مسبقا',
            'section_name.max' =>'اسم القسم يجب الا يزيد عن 255 حرف',
            'description.required' =>'يرجي ادخال الوصف',
        ]);

        $sections=Section::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'updated_by' => Auth::user()->name,
        ]);
        session()->flash('edit', 'تم تعديل القسم بنجاح');
        return redirect('/sections');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        $sections=Section::find($id);
        $sections->delete();
        session()->flash('delete', 'تم حذف القسم بنجاح');
        return redirect('/sections');
    }
}
