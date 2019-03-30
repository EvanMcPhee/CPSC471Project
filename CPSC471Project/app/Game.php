<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
  protected $fillable = [
      'homeid', 'awayid', 'winnerid', 'leagueid', 'score', 'activityid', 'game_date',
  ];

  public function teams()
  {
    return $this->hasMany(Team::class);
  }

  public function league()
  {
    return $this->belongsTo(League::class);
  }
}
