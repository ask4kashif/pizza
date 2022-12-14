@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Product Page') }}
                    {{ __(' - Admin')  }}
                </div>
                <div class="card-body">
                    <form action="{{route('product.update',$product->slug)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group mb-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name"
                                class="form-control @error('name')
                                    is-invalid
                                @enderror"
                                placeholder="Enter Name" value="{{ $product->name }}" >

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="description">Description</label>
                                <textarea name="description"
                                id="description" cols="30" rows="10"
                                class="form-control
                                @error('description')
                                    is-invalid
                                @enderror">{{ $product->description  }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control
                                @error('price')
                                    is-invalid
                                @enderror"
                                placeholder="Enter Price"  value="{{ $product->price }}">

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="oldImage">Last Image</label>
                                <img src="{{asset('/images/'. $product->image)}}" alt="Not available" width="60px" height="50px">
                            </div>
                            <div class="form-group mb-2">
                                <label for="image">Choose Image</label>

                                <input type="file" name="image" id="image" class="form-control @error('image')
                                    is-invalid
                                @enderror"
                                placeholder="Enter Slug"  value="{{ $product->image }}">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <select class="form-select form-control @error('category_id')
                                is-invalid
                                @enderror
                                " aria-label="Default select example" name="category_id">
                                    <option selected disabled>Open this select menu</option>
                                    @php
                                        $categories=App\Models\Category::all();
                                    @endphp
                                        {{-- {{dd($categories)}} --}}
                                    @foreach ( $categories as $category )
                                        <option value="{{$category->id}}" @if ($category->id==$product->category_id)
                                            selected
                                        @endif >{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <button type="submit" class="form-control btn btn-primary mb-2">Submit</button>
                                {{-- {{dd(Session()->all())}} --}}
                                <a href="{{route('product.index')}}" class="form-control btn btn-outline-info">Back</a>
                            </div>
                        </form>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
