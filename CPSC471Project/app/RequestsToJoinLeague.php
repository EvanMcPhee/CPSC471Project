<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestsToJoinLeague extends Model
{
  protected $fillable = [
      'content', 'teamid', 'leagueid',
  ];

  public function team()
  {
    return $this->belongsTo(Team::class);
  }
}
