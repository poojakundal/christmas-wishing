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
            <form method="POST" action="{{ route('my-wishlist.store') }}" enctype='multipart/form-data'>
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="item_name">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="item_name" class="form-control @error('item_name') is-invalid @enderror" id="item_name" placeholder="Name" value="{{ old('item_name') }}" autocomplete="item_name" autofocus />
                        @error('item_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="item_picture">Picture</label>
                    <div class="col-sm-10">
                        <input type="file" name="item_picture" class="form-control @error('item_picture') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg" />
                        @error('item_picture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="item_price">Price</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge @error('item_price') is-invalid @enderror">
                            <span class="input-group-text @error('item_price') custom-error @enderror">$</span>
                            <input type="number" name="item_price" class="form-control @error('item_price') is-invalid @enderror" placeholder="100" ria-label="Amount (to the nearest dollar)" />
                            <!-- <span class="input-group-text">.00</span> -->
                        </div>
                        
                        @error('item_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="item_quantity">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" name="item_quantity" class="form-control @error('item_quantity') is-invalid @enderror" id="item_quantity" placeholder="Quantity" value="{{ old('item_quantity') }}" autocomplete="item_quantity" autofocus />
                        @error('item_quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add to wishlist</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

