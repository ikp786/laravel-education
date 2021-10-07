@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Subjects List') }}</div>

    <div class="card-body">
        @can('subject_create')
        <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">Add New Subject</a>
        <a href="{{ route('admin.subject.trash-data') }}" class="btn btn-primary">Go to trash</a>
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
            @forelse ($subjects as $subject)
            <tr>
                <td class="text-center">{{$subject->id}}</td>
                <td>{{$subject->name}}</td>
                <td>{{$subject->status}}</td>
                <td><a href="{{ route('admin.subjects.edit',$subject->id) }}" class="btn btn-sm btn-warning">Edit</a> </td>
                <td><a href="{{ route('admin.subject.delete',['id' => $subject->id]) }}"><button class="btn btn-sm btn-danger">
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
@if($subjects->total() > $subjects->perPage())
<br><br>
{{$subjects->links()}}
@endif

</div>
</div>

@endsection
