@extends('layouts.new')

@section('title')
    {{ __('Group') }}
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="float-start">{{ __('Groups') }}</h3>
            <a class="btn btn-primary float-end" href="{{ route('group.create') }}">Create</a>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table" style="width:100%;">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Users</th>
                            <th scope="col">View Wishlist of Users</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($groups->count() > 0)
                            @foreach($groups as $i => $groups)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td>{{ $groups->name }}</td>
                                    <td>{{ $groups->groupUser->count() }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('group.wishlist',['group' => $groups->id]) }}">View User Wishlist</a>
                                    </td>
                                    <td>
                                        <div class="d-inline-block text-nowrap">
                                            <button class="btn btn-sm btn-icon">
                                                <a href="{{ route('group.edit',['group' => $groups->id]) }}"><i class="bx bx-edit"></i></a>
                                            </button>
                                            <div class="btn btn-sm btn-icon delete-record">
                                                <form method="POST" action="{{ route('group.destroy',['group' => $groups->id]) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-sm btn-icon" type="submit" class="submit-button">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td> 
                                    <!-- <td class="d-flex justify-content-around">
                                        <a class="btn btn-info" href="{{ route('group.edit',['group' => $groups->id]) }}">Edit</a>
                                        <form method="POST" action="{{ route('group.destroy',['group' => $groups->id]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </div>
                                        </form>
                                    </td>     -->
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5"> No data found </td>
                            </tr>
                        @endif
                    </tbody>                             
                </table>
            </div>
        </div>
    </div>
</div>

@endsection