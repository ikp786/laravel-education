@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">{{ __('Edit Subject') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.topics.update',$topics->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $topics->name) }}" required autocomplete="name">
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
                        @elseif($topics->status == 'Active')
                        selected="select" 
                        @endif value="Active">Active</option>
                        <option @if(old('status') == "Inactive") 
                        selected="select" 
                        @elseif($topics->status == 'Inactive')
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


            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
