<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  protected $fillable = [
      'name', 'captain_username', 'leagueid',
  ];

  public function users()
  {
    return $this->hasMany(User::class);
  }

  public function league()
  {
    return $this->belongsTo(League::class);
  }
}
