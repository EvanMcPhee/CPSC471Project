@extends('layouts.app')
@section('content')
<script>



</script>

<div class="container-fluid">
  <div class='row'>
    <div class='col-md-4'>
    </div>
  <div class='col-md-3' align='center'>
<h2> Create new conversation: </h2>
  </div>
  <div class='col-md-1'>
    <button type='button' class='btn btn-primary btn-block' onclick="location.href='{{url('messagecreate')}}'"> Create </button>
  </div>
</div>

<div class='row'>
</br>
</br>
</div>

<div class='row'>
  <div class='col-md-12' align='center'>
    <h2> Current Conversations: </h2>
  </div>
</div>
@foreach($allusers as $otheruser)
  @foreach($allmsgs as $msg)
    @if(($otheruser->username == $msg->reciever && $user->username == $msg->sender) || ($otheruser->username == $msg->sender && $user->username == $msg->reciever))
      <div class='row'>
        <div class='col-md-4'>
        </div>
        <div class='col-md-4'>
          <form method="get" action="{{ action('UserController@conversation', $otheruser->username) }}">
            {{ csrf_field() }}
          <button type='submit' name='username' value='{{$otheruser->username}}' class='btn btn-secondary btn-lg btn-block'> {{$otheruser->username}} </button>
          </form>
        </div>
        <div class='col-md-4'>
        </div>
      </div>
    <div class='row'>
    </br>
    </div>
      @break
    @endif
  @endforeach
@endforeach

</div>
@endsection
