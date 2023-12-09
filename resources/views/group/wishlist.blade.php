@extends('layouts.new')

@section('title')
    {{ __('Group Wishlist') }}
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <!-- <div class="card-header"> -->
            <h3 class="card-header">{{ __('User Wishlist') .' - '. $group->name }}</h3>
        <!-- </div> -->
        <div class="card-body">
            <div class="accordion mt-3" id="accordionExample">
                @foreach($users as $i => $user)
                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$user->id}}" aria-expanded="false" aria-controls="collapse{{$user->id}}">
                            <div class="avatar me-3">
                                <img src="{{$user->profile_picture_path}}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>{{ $user->name }}({{$user->wishList->count()}})
                            </button>
                        </h2>
                        <div id="collapse{{$user->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Picture</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Is Brought</th>
                                                <th scope="col">Mark as Brought</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($user->wishList->count() > 0)
                                                @foreach($user->wishList as $i => $myWishList)
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
                                                        <td class="item-brought-{{$myWishList->id}}">{{ ($myWishList->item_brought == false) ? 'No' : 'Yes' }}</td>
                                                        <td>
                                                            <input class="form-check-input item-brought" data-bs-toggle="modal" data-bs-target="#confirmBrought" type="checkbox" value="{{$myWishList->id}}" {{ ($myWishList->item_brought == false) ? 'No' : 'checked disabled' }}>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else 
                                                <tr>
                                                    <td class="text-center" colspan="6">No Item Added in Wishlist</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmBrought" tabindex="-1" aria-labelledby="confirmBroughtLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="confirmBroughtLabel">Mark as brought</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to make this item as brought
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="mark-yes">Yes</button>
                <button type="button" class="btn btn-secondary" id="mark-no" data-bs-dismiss="modal">No</button>
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
        var itemID;
        $('.item-brought').click(function(){
            itemID = $(this).val();
        });
        $('#mark-yes').click(function(){
            $.ajax({
                url : '/mark-brought',
                type : 'POST',
                data : {
                    'item_id' : itemID
                },
                dataType:'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success : function(data) { 
                    if(data.success) {    
                        $('#confirmBrought').modal('toggle');       
                        $(".item-brought[value='" + itemID + "']").prop('disabled', true);
                        $(".item-brought-" + itemID).html('Yes');
                    }
                },
                error : function(request,error)
                {
                    alert("Request: "+JSON.stringify(request));
                }
            });
        });
        $('#mark-no').click(function(){
            $(".item-brought[value='" + itemID + "']").prop('checked', false);
            
        });
        $('.img-modal').click(function(){
            $('.display-item-img').attr('src',$(this).attr("data-img"));
        });
    });
</script>
@endsection