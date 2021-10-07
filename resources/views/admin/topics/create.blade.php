@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">{{ __('Add New Topic') }}</div>

    <div class="card-body">
        @can('subject_create')
        <a href="{{ route('admin.topics.index') }}" class="btn btn-primary">Show Topic list</a>        
        @endcan
        <br /><br />
        <form method="POST" action="{{ route('admin.topics.store') }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" f autocomplete="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                <div class="col-md-6"> 
                    <select name="status" class="form-control">
                        <option value=""> Select Status</option>
                        <option @if(old('status') == "Active") 
                        selected="select" 
                        @endif value="Active">Active</option>
                        <option @if(old('status') == "Inactive") 
                        selected="select" 
                        @endif value="Inactive">Inactive</option>
                        
                    </select>
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                <div class="col-md-6"> 
                    
                    {{ Form::select('subject_id', $subjects, '', ['class' => 'form-control']) }}
                    @error('status')
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