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
  <form class="form-horizontal" method="post" action="{{ action('UserController@messageUpdate') }}" >

    {{ csrf_field() }}

      <h3>Conversation with:</h3>
      <input type="text" name="username" class="form-control" placeholder="{{$reciever}}" value="{{$reciever}}" readonly>

    <div class="form-group">
      <h3>Messages:</h3>
      <div style="height: 400px; overflow-y: scroll;">
        @foreach($msgs as $msg)
        @if($msg->sender == $sender)
        <h6>
          {{$msg->content}} </br>
        </h6>
        <p>
          {{$msg->created_at}} </br>
        </p>
        @else
        <div style="background-color: lightgrey;">
          <h6 style="text-align: right; margin-right:20px;">
            {{$msg->content}} </br>
          </h6>
          <p style="text-align: right; margin-right:20px;">
            {{$msg->created_at}} </br>
          </p>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    <div class="form-group">
      <label for="content">New Message:</label>
      <textarea name='content' class='form-control' rows='5'></textarea>
    </div>

    <div class ="form-group">
      <button type="submit" class="btn btn-primary">Send Message</button>
    </div>

  </form>

</div>
@endsection
