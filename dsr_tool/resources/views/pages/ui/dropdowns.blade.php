@extends('layouts.app')

@section('title', 'Dropdowns | Corona Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title"> Dropdowns </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">UI Elements</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dropdowns</li>
    </ol>
  </nav>
</div>
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Basic dropdown</h4>
        <p class="card-description"> Wrap the dropdown’s toggle and the menu within <code>.dropdown</code></p>
        <div class="template-demo">
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <h6 class="dropdown-header">Settings</h6>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
