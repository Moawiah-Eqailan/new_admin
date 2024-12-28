@extends('layouts.app')
  
@section('title', 'Profile')
  
@section('contents')
    <h1 class="mb-0">Profile</h1>
    <hr />
 
    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="" >
    <div class="row">
        <div class="col-md-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile </h4>
                </div>
                <div class="row" id="res"></div>
                <div class="row mt-2">
  
                    <div class="col-md-6">
                        <label class="labels">Name</label>
                        <input type="text" name="name" class="form-control" disabled placeholder="first name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Email</label>
                        <input type="text" name="email" disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                    </div>
                </div>
                <!-- <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone }}">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}" placeholder="Address">
                    </div>
                </div> -->
                 
                <!-- <div class="mt-5 text-center"><button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button></div> -->
            </div>
        </div>
         
    </div>   
            
        </form>
@endsection















@include('UsersPage.layouts.header')

<section id="items" class="position-relative">
    <div class="container my-5 py-5">

        @if($filteredParts->isEmpty())
        <div class="detail mb-4 text-center">
            <p class="hero-paragraph">No parts found for the selected criteria.</p>
        </div>
        @else
        <div class="swiper items-swiper mb-5">
            <div class="swiper-wrapper">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div class="d-flex flex-wrap justify-content-between gap-4">
                                    @foreach($filteredParts as $item)
                                    <div class="card mb-3" style="max-width: 540px; flex: 1 0 {{ $filteredParts->count() == 1 ? '100%' : '30%' }}; max-width: {{ $filteredParts->count() == 1 ? '100%' : '30%' }}">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                @if($item->item_image)
                                                <img src="{{ asset('storage/' . $item->item_image) }}" class="img-fluid rounded-start" alt="item-image" style="height: 200px; object-fit: contain;">
                                                @else
                                                <p class="text-center">No image available</p>
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h4 class="card-title">{{ $item->item_name }}
                                                            <a href="javascript:void(0);" onclick="toggleHeart(this, '{{ $item->item_name }}')">
                                                                <i class="{{ $item->isFavorite ? 'fa-solid' : 'fa-regular' }} fa-heart" style="margin: 5px; color:red" onclick="toggleHeart(this)"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <hr>
                                                    <h5 class="card-title">{{ $item->item_name }}</h5>
                                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                    <p class="card-text">{{ $item->item_description }}</p>

                                                    <button style="margin: 2px;" type="button" class="btn btn-primary" onclick="addToCart('{{ $item->id }}', '{{ $item->item_name }}')">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

       
    </div>
</section>

@include('UsersPage.layouts.footer')


