@extends('layouts.layout')
@section('content')
 
 
<div class="card">
  <div class="card-header">Students Page</div>
  <div class="card-body">
   
 
        <div class="card-body">
        <h5 class="card-title">Name : {{ $students->name }}</h5>
        <p class="card-text">Address : {{ $students->address }}</p>
        <p class="card-text">Mobile : {{ $students->mobile }}</p>
  </div>
       
    </hr>
  <div class="card-footer">
    <a href="{{ url('/student/')}}" title="return Index"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Return</button></a>
  </div>
  </div>
</div>