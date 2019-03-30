<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestsToJoinTeam extends Model
{
  protected $fillable = [
      'content', 'teamid', 'username',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
