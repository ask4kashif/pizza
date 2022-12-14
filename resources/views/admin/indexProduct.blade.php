@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Product index page') }}
                    {{ __(' - Admin')  }}
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <a href="{{route('product.create')}}" class="btn btn-outline-dark">Create Product</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                            @forelse($products as $key => $product)
                          <tr>
                            <td>{{$product->name}}</td>
                            <td ><img src="{{asset('/images/'. $product->image)}}" alt="Not available" width="60px" height="50px"></td>
                            <td>{{$product->category['name']}}</td>
                            <td><a href="{{route('product.edit', $product->slug)}}" class="btn btn-outline-success">Edit</a></td>
                            <td>

                                <form id="delete-form" enctype="multipart/form-data"
                                method="POST" action="{{route('product.destroy',$product->slug)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <div class="form-group">
                                      <input type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('Are you sure ?')">
                                    </div>
                                  </form>
                            </td>
                          </tr>
                          @empty
                          {{('No record found')}}
                          @endforelse
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
