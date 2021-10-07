<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        abort_if(Gate::denies('subject_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $subjects = Subject::paginate(5);
        return view('admin.subjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('subject_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin/subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       abort_if(Gate::denies('subject_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

       $this->validate($request, [
        'name' => 'required',
        'status' => 'required',
    ]);
       $input = $request->all();
       Subject::create($input);
      // dd($input);
       return redirect()->route('admin.subjects.index')->with('status-success','New Subject Created');
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('subject_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $subjects = Subject::find($id);        
        return view('admin.subjects.edit',compact('subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('subject_update'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $this->validate($request, [
            'name' => 'required',
        ]);
        $subject = Subject::find($id);
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->save();
        return redirect()->route('admin.subjects.index')->with('status-success','Subject Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete($id)
    {
        abort_if(Gate::denies('subject_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $subject = Subject::find( $id );
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('status-success','Move to trash Subject');
    }

    public function trashData()
    {
        abort_if(Gate::denies('subject_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $subjects = Subject::onlyTrashed()->paginate();
        return view('admin.subjects.trash-data',compact('subjects'));
    }

    public function permanetDelete($id)
    {
        abort_if(Gate::denies('subject_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $stream = Subject::onlyTrashed()->find($id);
        $stream->forceDelete();
        return redirect()->route('admin.subjects.index')->with('status-success','Permanent deleted.');
    } 

    public function restore($id)
    {
        abort_if(Gate::denies('subject_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $stream = Subject::withTrashed()->find($id);
        $stream->restore();
        return redirect()->route('admin.subjects.index')->with('status-success','restore data sucessfully');
    }
}