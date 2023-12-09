@extends('layouts.new')

@section('title')
    {{ __('Add to Wishlist') }}
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="float-start">{{ __('Add to Wishlist') }}</h3>
        </div>
        <!-- <div class="card-header">{{ __('Add to Wishlist') }}</div> -->

        <div class="card-body">
            <form method="POST" action="{{ route('group.store') }}" enctype='multipart/form-data'>
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="item_name">Group Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name') }}" autocomplete="name" autofocus />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="users">Add Users</label>
                    <div class="col-sm-10">
                        <select id="users" name="users[]" multiple>
                            @foreach($userLists as $i => $userList)
                                <option value="{{ $userList->id }}">{{ $userList->name }}</option>
                            @endforeach
                        </select>
                        <input class="form-control @error('users') is-invalid @enderror" type="hidden" />
                        @error('users')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Create Group</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('select').fSelect();

    if ($('.fs-label.form-control').html() == 'Select some options') {
        $('.fs-label.form-control').css('color', '#b4bdc6');
    }
    $('#users').change( function() {
        if ($('.fs-label.form-control').html() == 'Select some options') {
            $('.fs-label.form-control').css('color', '#b4bdc6');
        } else {
            $('.fs-label.form-control').css('color', '#697a8d');
        }
    });
  });
</script>
@endsection