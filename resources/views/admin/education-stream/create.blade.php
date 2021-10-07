@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">{{ __('Add New Stream') }}</div>

    <div class="card-body">
        @can('role_create')
        <a href="{{ route('admin.educationstreams.index') }}" class="btn btn-primary">Show Stream list</a>        
        @endcan
        <br /><br />
        <form method="POST" action="{{ route('admin.educationstreams.store') }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>



            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var permission_select = new SlimSelect({
        select: '#permissions-select select',
            //showSearch: false,
            placeholder: 'Select Permissions',
            deselectLabel: '<span>&times;</span>',
            hideSelectedOption: true,
        })

    $('#permissions-select #permission-select-all').click(function(){
        var options = [];
        $('#permissions-select select option').each(function(){
            options.push($(this).attr('value'));
        });

        permission_select.set(options);
    })

    $('#permissions-select #permission-deselect-all').click(function(){
        permission_select.set([]);
    })
</script>
@endsection
