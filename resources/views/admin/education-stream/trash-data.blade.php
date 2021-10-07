@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Education Stream List') }}</div>

    <div class="card-body">
        @can('role_create')
        <a href="{{ route('admin.educationstreams.index') }}" class="btn btn-primary">Show Stream List</a>
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
            @forelse ($streams as $stream)
            <tr>
                <td class="text-center">{{$stream->id}}</td>
                <td>{{$stream->name}}</td>
                <td>{{$stream->status}}</td>                
                <td><a href="{{ route('admin.educationstream.restore',['id' => $stream->id]) }}"> restore</i></a>
                </td>
                <td><a class="delete" href="{{ route('admin.educationstream.force-delete',['id' => $stream->id]) }}">Premanet delete</i></a></td>
            </tr>
            @empty
            <tr>
                <td colspan="100%" class="text-center text-muted py-3">No Education Stream Found</td>
            </tr>
            @endforelse
        </table>
        @if($streams->total() > $streams->perPage())
        <br><br>
        {{$streams->links()}}
        @endif

    </div>
</div>

<script type="text/javascript">
    $('.delete').click(function() {
    return confirm('Are You Sure to delete this stream?')
});
</script>    

@endsection
