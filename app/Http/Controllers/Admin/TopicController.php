<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Subject;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        abort_if(Gate::denies('subject_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $topics = Topic::with('subject')->paginate(5);        
        return view('admin.topics.index',compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('subject_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $subjects = Subject::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');

        return view('admin/topics.create',compact('subjects'));
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
     Topic::create($input);
      // dd($input);
     return redirect()->route('admin.topics.index')->with('status-success','New Topic Created');
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

        $topics = Topic::find($id);        
        return view('admin.topics.edit',compact('topics'));
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
        $subject = Topic::find($id);
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->save();
        return redirect()->route('admin.topics.index')->with('status-success','Topic Updated');
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

        $subject = Topic::find( $id );
        $subject->delete();
        return redirect()->route('admin.topics.index')->with('status-success','Move to trash Topic');
    }

    public function trashData()
    {
        abort_if(Gate::denies('subject_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $topics = Topic::onlyTrashed()->paginate();
        return view('admin.topics.trash-data',compact('topics'));
    }

    public function permanetDelete($id)
    {
        abort_if(Gate::denies('subject_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $stream = Topic::onlyTrashed()->find($id);
        $stream->forceDelete();
        return redirect()->route('admin.topics.index')->with('status-success','Permanent deleted.');
    } 

    public function restore($id)
    {
        abort_if(Gate::denies('subject_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $stream = Topic::withTrashed()->find($id);
        $stream->restore();
        return redirect()->route('admin.topics.index')->with('status-success','restore data sucessfully');
    }
}