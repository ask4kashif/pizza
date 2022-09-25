@extends('user.layout.app')

@section('title','Welcome Page')

@section('main')
@include('user.include.slider')
@include('user.include.miniAbout')
@include('user.include.intro')
@include('user.include.miniServices')
@include('user.include.hotDeals')
@include('user.include.miniContact')

@endsection
