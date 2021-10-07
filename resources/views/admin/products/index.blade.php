@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Products List') }}</div>

        <div class="card-body">
            @can('product_create')
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
            @endcan

            <br /><br />



                <table class="table table-borderless table-hover">
                            <tr class="bg-info text-light">
                                <th class="text-center">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                           
                    @forelse ($products as $user)
                        <tr>
                            <td class="text-center">{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role->title ?? "--"}}</td>
                            <td>
                                    @can('product_show')
                                        <a href="{{ route('admin.products.show', $user->id) }}" class="btn btn-sm btn-success">Show</a>
                                    @endcan
                                    @can('product_edit')
                                        <a href="{{ route('admin.products.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    @endcan
                                    @can('product_delete')
                                <form action="{{ route('admin.products.destroy', $user->id) }}" class="d-inline-block" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center text-muted py-3">No Products Found</td>
                            </tr>
                    @endforelse
                </table>




            {{-- @if($products->total() > $products->perPage())
            <br><br>
            {{$products->links()}}
            @endif --}}

        </div>
    </div>

@endsection
