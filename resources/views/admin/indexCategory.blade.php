@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Category index page') }}
                    {{ __(' - Admin')  }}
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <a href="{{route('category.create')}}" class="btn btn-outline-dark">Create Cateogry</a>
                    @forelse($categories as $key => $category)
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{$category->name}}</td>
                            <td >{{ ucfirst(trans($category->slug))}}</td>
                            <td><a href="{{route('category.edit', $category->slug)}}" class="btn btn-outline-success">Edit</a></td>
                            <td>

                                <form id="delete-form" method="POST" action="{{route('category.destroy',$category->slug)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="form-group">
                                      <input type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('Are you sure ?')">
                                    </div>
                                  </form>
                            </td>
                          </tr>
                        </tbody>
                        @empty
                        {{('No record found')}}
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
