<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message;
use App\User;
use DB;

class UserController extends Controller
{
    //
    function userHome(){
      $user = Auth::user();
      return view('user.userhome', compact('user'));
    }

    function messageHome(){
      $user = Auth::user();
      $allmsgs = DB::table('messages')->select('sender','reciever')->where('sender','=',$user->username)->orWhere('reciever','=',$user->username)->get();//Message::all();
      $allusers = User::all();
      return view('user.messagehome', compact('user','allmsgs','allusers'));
      }

      function messageCreate(){

        return view('user.messagecreate');
        }

        public function messageStore(Request $message)
        {
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
              $user = Auth::user();
              $allmsgs = DB::table('messages')->select('sender','reciever')->where('sender','=',$user->username)->orWhere('reciever','=',$user->username)->get();
              $allusers = User::all();
              return view('user.messagehome', compact('user','allmsgs','allusers'));

            } else {
              $failmessage = "Sorry that user does not exist";
              return view('user.messagecreate', compact('failmessage'));
            }
        }

        public function messageStoreDirect(Request $message)
        {
            $currentuser = Auth::user();

            $newmessage = new Message();
            $newmessage->sender = $currentuser->username;
            $newmessage->reciever = $message->username;
            $newmessage->content = $message->content;
            $newmessage->save();


            $user = DB::table('users')->where('username','=',$message->username)->first();
            $teamstats = DB::table('belongs_tos')->where('username','=',$user->username)
                        ->join('teams','belongs_tos.teamid','=','teams.id')
                        ->join('leagues','teams.leagueid','=','leagues.id')
                        ->join('games','leagues.id','=','games.leagueid')
                        ->join('stats','games.id','=','stats.gameid')
                        ->select('teams.id','stats.stat_type','stats.value')
                        ->where('stats.player_username','=',$user->username)
                        ->get();
            $teams = DB::table('belongs_tos')->where('username','=',$user->username)
                        ->join('teams','belongs_tos.teamid','=','teams.id')
                        ->get();

            return view('user.userhome', compact('user','teams','teamstats'));

        }

        function show($id){
          $user = DB::table('users')->where('id','=',$id)->first();
          $teamstats = DB::table('belongs_tos')->where('username','=',$user->username)
                      ->join('teams','belongs_tos.teamid','=','teams.id')
                      ->join('leagues','teams.leagueid','=','leagues.id')
                      ->join('games','leagues.id','=','games.leagueid')
                      ->join('stats','games.id','=','stats.gameid')
                      ->select('teams.id','stats.stat_type','stats.value')
                      ->where('stats.player_username','=',$user->username)
                      ->get();
          $teams = DB::table('belongs_tos')->where('username','=',$user->username)
                      ->join('teams','belongs_tos.teamid','=','teams.id')
                      ->get();




          return view('user.userhome', compact('user','teams','teamstats'));
        }

        function conversation(Request $request){
          $sender = Auth::user();
          $sender = $sender->username;

          $reciever = DB::table('users')->select('username')->where('users.username','=',$request->username)->first();
          $reciever = $reciever->username;

          $msgs = DB::table('messages') //SELECT * FROM messages
                                ->where([['sender','=', $sender],['reciever','=', $reciever]]) //WHERE messages.sender = $sender AND messages.reciever = $reciever
                                ->orWhere([['sender','=', $reciever],['reciever','=', $sender]]) // OR WHERE messages.sender = $reciever AND messages.reciever = $sender
                                ->orderBy('id','asc') //order id in ascending order
                                ->get();//gives us the result of the query as an object

          return view('user.conversation', compact('reciever','sender','msgs'));
        }

        public function messageUpdate(Request $message)
        {

            $newmessage = new Message();
            $currentuser = Auth::user();

            $newmessage = new Message();
            $newmessage->sender = $currentuser->username;
            $newmessage->reciever = $message->username;
            $newmessage->content = $message->content;
            $newmessage->save();

            $sender = Auth::user();
            $sender = $sender->username;

            $reciever = DB::table('users')->select('username')->where('users.username','=',$message->username)->first();
            $reciever = $reciever->username;

            $msgs = DB::table('messages') //SELECT * FROM messages
                                  ->where([['sender','=', $sender],['reciever','=', $reciever]]) //WHERE messages.sender = $sender AND messages.reciever = $reciever
                                  ->orWhere([['sender','=', $reciever],['reciever','=', $sender]]) // OR WHERE messages.sender = $reciever AND messages.reciever = $sender
                                  ->orderBy('id','asc') //order id in ascending order
                                  ->get();//gives us the result of the query as an object

            return view('user.conversation', compact('reciever','sender','msgs'));
        }



        public function messageSend($username)
        {
          $directusername = $username;
          return view('user.messagecreate', compact('directusername'));
        }

}
