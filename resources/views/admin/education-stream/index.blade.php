@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Education Stream List') }}</div>

    <div class="card-body">
        @can('role_create')
        <a href="{{ route('admin.educationstreams.create') }}" class="btn btn-primary">Add New Education Stream</a>
        <a href="{{ route('admin.educationstream.trash-data') }}" class="btn btn-primary">Go to trash</a>
        @endcan

        <br /><br />

        <table class="table table-borderless table-hover">
            <tr class="bg-info text-light">
                <th class="text-center">ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Trash</th>
            </tr>
            @forelse ($streams as $stream)
            <tr>
                <td class="text-center">{{$stream->id}}</td>
                <td>{{$stream->name}}</td>
                <td>{{$stream->status}}</td>
                <td><a href="{{ route('admin.educationstreams.edit',$stream->id) }}" class="btn btn-sm btn-warning">Edit</a> </td>
                <td><a href="{{ route('admin.educationstream.delete',['id' => $stream->id]) }}"><button class="btn btn-sm btn-danger">
                    <i class="fa fa-trash"></i>
                
            </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="100%" class="text-center text-muted py-3">No Education Stream Found</td>
            </tr>
            </tr>
            @endforelse
        </table>
        @if($streams->total() > $streams->perPage())
        <br><br>
        {{$streams->links()}}
        @endif

    </div>
</div>

@endsection
