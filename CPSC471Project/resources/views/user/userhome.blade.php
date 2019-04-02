@extends('layouts.app')
@section('content')
<script>



</script>

<div class="container-fluid">
  <div class='row'>
  <div class='col-md-6'>
<h1> Hello {{$user->username}}, <small> Welcome to your homepage!</small> </h1>
  </div>
  <div class='col-md-6'>
    <h2> Your Teams: </h2>
  </div>
</div>

<div class='row'>
  <div class='col-md-4'>
    <button type='button' class='btn btn-primary btn-lg' onclick="location.href='{{url('messagehome')}}'"> Messages </button>
  </div>
</div>

</div>
@endsection
