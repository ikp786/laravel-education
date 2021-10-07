@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Subject List') }}</div>

    <div class="card-body">
        @can('subject_access')
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-primary">Show Subject List</a>
        @endcan

        <br /><br />



        <table class="table table-borderless table-hover">
            <tr class="bg-info text-light">
                <th class="text-center">ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Restore</th>
                <th>force delete</th>
            </tr>
            @forelse ($subjects as $subject)
            <tr>
                <td class="text-center">{{$subject->id}}</td>
                <td>{{$subject->name}}</td>
                <td>{{$subject->status}}</td>                
                <td><a href="{{ route('admin.subject.restore',['id' => $subject->id]) }}"> restore</i></a>
                </td>
                <td><a class="delete" href="{{ route('admin.subject.force-delete',['id' => $subject->id]) }}">Premanet delete</i></a></td>
            </tr>
            @empty
            <tr>
                <td colspan="100%" class="text-center text-muted py-3">No Education subject Found</td>
            </tr>
            @endforelse
        </table>
        @if($subjects->total() > $subjects->perPage())
        <br><br>
        {{$subjects->links()}}
        @endif

    </div>
</div>

<script type="text/javascript">
    $('.delete').click(function() {
    return confirm('Are You Sure to delete this subject?')
});
</script>    

@endsection
