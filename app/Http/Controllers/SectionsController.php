<?php

namespace App\Http\Controllers;


use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.section',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $b_exists = sections::where('section_name','=',$input['section_name'])->exists();

        if ($b_exists){

            session()->flash('Error','Section is already registered');
            return redirect('/sections');
        }
        else{

            sections::create([
                'section_name' => $request -> section_name,
                'description' => $request -> description,
                'created_by' =>(Auth::user()->name),
            ]);

            session()->flash('Success','Section has been added Successfully');
            return redirect('/sections');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $id = $request->id;
        $b_exists = sections::where('section_name','=',$input['section_name'])->exists();

        if ($b_exists){

            session()->flash('Error','Section is already registered');
            return redirect('/sections');
        }
        else{
            $sections = sections::find($id);
            $sections->update([
                'section_name' => $request->section_name,
                'description' => $request->description,
            ]);

            session()->flash('edit','Section edited successfully');
            return redirect('/sections');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        sections::find($id)->delete();
        session()->flash('delete','Section deleted successfully');
        return redirect('/sections');
    }
}
