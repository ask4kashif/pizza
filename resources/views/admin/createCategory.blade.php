@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Category Page') }}
                    {{ __(' - Admin')  }}
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('category.store')}}" method="post">
                        @csrf
                            <div class="form-group mb-2">
                                <input type="text" name="name" id="name"
                                class="form-control @error('name')
                                    is-invalid
                                @enderror"
                                placeholder="Enter Name" value="{{ old('name') }}" >

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="slug" id="slug" class="form-control @error('slug')
                                    is-invalid
                                @enderror"
                                placeholder="Enter Slug"  value="{{ old('slug') }}">
                                @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary mb-2">Submit</button>
                                {{-- {{dd(Session()->all())}} --}}
                                <a href="{{route('category.index')}}" class="form-control btn btn-outline-info">Back</a>
                            </div>
                        </form>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
