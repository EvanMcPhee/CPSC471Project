<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
  protected $fillable = [
      'gameid', 'player_username', 'stat_type', 'value',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function game()
  {
    return $this->belongsTo(Game::class);
  }
}
