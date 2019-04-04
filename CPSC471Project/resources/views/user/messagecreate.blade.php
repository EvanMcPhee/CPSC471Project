@extends('layouts.app')
@section('content')
<script>



</script>
@if(!empty($failmessage))
  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Sorry that user does not exist </strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>
@endif
<div class="container-fluid">
  <form class="form-horizontal" method="post" action="{{ action('UserController@messageStore') }}">

    {{ csrf_field() }}

    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" name="username" class="form-control">
    </div>

    <div class="form-group">
      <label for="content">Message:</label>
      <textarea name='content' class='form-control' rows='5'></textarea>
    </div>

    <div class ="form-group">
      <button type="submit" class="btn btn-primary">Send Message</button>
    </div>

  </form>
</div>



</div>
@endsection
