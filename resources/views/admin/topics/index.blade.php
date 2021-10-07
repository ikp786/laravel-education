@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">{{ __('Topic List') }}</div>
    <div class="card-body">
        @can('subject_create')
        <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">Add New Topic</a>
        <a href="{{ route('admin.topic.trash-data') }}" class="btn btn-primary">Go to trash</a>
        @endcan
        <br /><br />
        <table class="table table-borderless table-hover">
            <tr class="bg-info text-light">
                <th class="text-center">ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Subject</th>
                <th>Edit</th>
                <th>Trash</th>
            </tr>
            @forelse ($topics as $topic)
            <tr>
                <td class="text-center">{{$topic->id}}</td>
                <td>{{$topic->name}}</td>
                <td>{{$topic->status}}</td>
                <td>{{$topic->subject->name}}</td>
                <td><a href="{{ route('admin.topics.edit',$topic->id) }}" class="btn btn-sm btn-warning">Edit</a> </td>
                <td><a href="{{ route('admin.topic.delete',['id' => $topic->id]) }}"><button class="btn btn-sm btn-danger">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="100%" class="text-center text-muted py-3">No Subject Found</td>
        </tr>
    </tr>
    @endforelse
</table>
@if($topics->total() > $topics->perPage())
<br><br>
{{$topics->links()}}
@endif
</div>
</div>
@endsection