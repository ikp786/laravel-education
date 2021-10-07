@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">{{ __('Topic List') }}</div>
    <div class="card-body">
        @can('subject_access')
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-primary">Show Topic List</a>
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
            @forelse ($topics as $topic)
            <tr>
                <td class="text-center">{{$topic->id}}</td>
                <td>{{$topic->name}}</td>
                <td>{{$topic->status}}</td>
                <td><a href="{{ route('admin.topic.restore',['id' => $topic->id]) }}"> restore</i></a>
                </td>
                <td><a class="delete" href="{{ route('admin.topic.force-delete',['id' => $topic->id]) }}">Premanet delete</i></a></td>
            </tr>
            @empty
            <tr>
                <td colspan="100%" class="text-center text-muted py-3">No Education topic Found</td>
            </tr>
            @endforelse
        </table>
        @if($topics->total() > $topics->perPage())
        <br><br>
        {{$topics->links()}}
        @endif
    </div>
</div>
<script type="text/javascript">
    $('.delete').click(function() {
    return confirm('Are You Sure to delete this topic?')
});
</script>    
@endsection