@extends('layouts.new')

@section('title')
    {{ __('My Wishlist') }}
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <!-- <div>
        <h5 class="card-header">My Wishlist</h5>
        <a class="btn btn-primary float-end" href="{{ route('my-wishlist.create') }}">Create</a> -->
        <div class="card-header">
            <h3 class="float-start">{{ __('Wishlist') }}</h3>
            <a class="btn btn-primary float-end" href="{{ route('my-wishlist.create') }}">Create</a>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap padding-table">
                <table class="table table-hover table-striped" style="width:100%;">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Is Brought</th>
                            <th scope="col">Brought By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($myWishLists->count() > 0)
                            @foreach($myWishLists as $i => $myWishList)
                                <tr>
                                    <th scope="row">{{ $i+1 }}</th>
                                    <td>{{ $myWishList->item_name }}</td>
                                    <td>
                                        @if($myWishList->item_picture == NULL) 
                                            -
                                        @else 
                                            <div class="img-modal" data-bs-toggle="modal" data-bs-target="#modalCenter" data-img="{{ asset('storage/item_picture/'.$myWishList->item_picture) }}">
                                                <i class="bx bx-show-alt mx-1"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $myWishList->item_price }}</td>
                                    <td>{{ $myWishList->item_quantity }}</td>
                                    <td>{{ ($myWishList->item_brought == false) ? 'No' : 'Yes' }}</td>
                                    <td>{{ ($myWishList->item_brought_by == NULL) ? '-' : $myWishList->broughtBy->name}}</td>    
                                    <td>
                                        <div class="d-inline-block text-nowrap">
                                            <button class="btn btn-sm btn-icon">
                                                <a class="{{ ($myWishList->item_brought == false) ? '' : 'disabled' }}" href="{{ route('my-wishlist.edit',['my_wishlist' => $myWishList->id]) }}"><i class="bx bx-edit"></i></a>
                                            </button>
                                            <div class="btn btn-sm btn-icon delete-record">
                                                <form method="POST" action="{{ route('my-wishlist.destroy',['my_wishlist' => $myWishList->id]) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-sm btn-icon" type="submit" class="submit-button">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>    
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="8"> No data found </td>
                            </tr>
                        @endif
                    </tbody>                              
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img class="display-item-img">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.img-modal').click(function(){
            $('.display-item-img').attr('src',$(this).attr("data-img"));
        });
    });
</script>
@endsection
