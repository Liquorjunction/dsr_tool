@extends('layouts.app')

@section('title', 'Font awesome | Corona Admin')

@push('plugin-styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
@endpush

@section('content')
<div class="page-header">
  <h3 class="page-title"> Font awesome </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Icons</a></li>
      <li class="breadcrumb-item active" aria-current="page">Font awesome</li>
    </ol>
  </nav>
</div>
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">New Icons</h4>
        <div class="icons-list row">
          <div class="col-sm-6 col-md-4 col-lg-3"> <i class="fa fa-address-book"></i> fa fa-address-book </div>
          <div class="col-sm-6 col-md-4 col-lg-3"> <i class="fa fa-address-book-o"></i> fa fa-address-book-o </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
