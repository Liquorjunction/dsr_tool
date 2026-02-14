@extends('layouts.app')

@section('title', 'Buttons | Corona Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title"> Buttons </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">UI Elements</a></li>
      <li class="breadcrumb-item active" aria-current="page">Buttons</li>
    </ol>
  </nav>
</div>
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Normal buttons</h4>
        <p class="card-description">Add class <code>.btn-{color}</code> for buttons in theme colors</p>
        <div class="template-demo">
          <button type="button" class="btn btn-primary btn-fw">Primary</button>
          <button type="button" class="btn btn-secondary btn-fw">Secondary</button>
          <button type="button" class="btn btn-success btn-fw">Success</button>
          <button type="button" class="btn btn-danger btn-fw">Danger</button>
          <button type="button" class="btn btn-warning btn-fw">Warning</button>
          <button type="button" class="btn btn-info btn-fw">Info</button>
          <button type="button" class="btn btn-light btn-fw">Light</button>
          <button type="button" class="btn btn-dark btn-fw">Dark</button>
          <button type="button" class="btn btn-link btn-fw">Link</button>
        </div>
      </div>
      </div>
  </div>
</div>
@endsection
