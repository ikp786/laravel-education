<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationStream;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
class EducationStreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('education_stream_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $streams = EducationStream::paginate(5);
        return view('admin.education-stream.index',compact('streams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('education_stream_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        return view('admin/education-stream/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        abort_if(Gate::denies('education_stream_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->all();
        EducationStream::create($input);
        return redirect()->route('admin.educationstreams.index')->with('status-success','New Education Stream Created');
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
        $stream = EducationStream::find($id);        
        return view('admin/education-stream.edit',compact('stream'));
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
        abort_if(Gate::denies('education_stream_update'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $this->validate($request, [
            'name' => 'required',
        ]);
        $stream = EducationStream::find($id);
        $stream->name = $request->name;
        $stream->save();
        return redirect()->route('admin.educationstreams.index')->with('status-success','Education Stream Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stream = EducationStream::find( $id );
        $stream->delete();
        return redirect()->route('admin.educationstreams.index')->with('status-success','Move to trash Education Stream');
    }

    public function delete($id)
    {
        abort_if(Gate::denies('education_stream_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $stream = EducationStream::find( $id );
        $stream->delete();
        return redirect()->route('admin.educationstreams.index')->with('status-success','Move to trash Education Stream');
    }

    public function trashData()
    {
        abort_if(Gate::denies('education_stream_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $streams = EducationStream::onlyTrashed()->paginate();
        return view('admin.education-stream.trash-data',compact('streams'));
    }

    public function permanetDelete($id)
    {
        abort_if(Gate::denies('education_stream_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $stream = EducationStream::onlyTrashed()->find($id);
        $stream->forceDelete();
        return redirect()->route('admin.educationstreams.index')->with('status-success','Permanent deleted.');
    } 

    public function restore($id)
    {
        abort_if(Gate::denies('education_stream_access'), Response::HTTP_FORBIDDEN, 'Forbidden');        
        $stream = EducationStream::withTrashed()->find($id);
        $stream->restore();
        return redirect()->route('admin.educationstreams.index')->with('status-success','restore data sucessfully');
    }
}