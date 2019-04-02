<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message;
use App\User;

class UserController extends Controller
{
    //
    function userHome(){
      $user = Auth::user();
      return view('user.userhome', compact('user'));
    }

    function messageHome(){
      $user = Auth::user();
      $allmsgs = Message::all();
      $allusers = User::all();
      return view('user.messagehome', compact('user','allmsgs','allusers'));
      }

      function messageCreate(){
        $user = Auth::user();
        $allmsgs = Message::all();
        $allusers = User::all();
        return view('user.messagecreate', compact('user','allmsgs','allusers'));
        }

        public function messageStore(Request $message)
        {
            
            $newmessage = new Message();
            $currentuser = Auth::user();
            $allusers = User::all();

            $flag = false;
            foreach ($allusers as $user) {
              if($message->username == $user->username){
                $flag = true;
                break;
              }
            }

            if($flag){
              $newmessage = new Message();
              $newmessage->sender = $currentuser->username;
              $newmessage->reciever = $message->username;
              $newmessage->content = $message->content;
              $newmessage->save();
              return redirect('messagehome');

            } else {
              $failmessage = "Sorry that user does not exist";
              $user = Auth::user();
              $allmsgs = Message::all();
              $allusers = User::all();
              return view('user.messagecreate', compact('user','allmsgs','allusers', 'failmessage'));
            }
        }
}
