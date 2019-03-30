<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
  protected $fillable = [
      'name', 'city', 'provice_state', 'description', 'admin_username', 'activityid',
  ];

  public function teams()
  {
    return $this->hasMany(Team::class);
  }

  public function equipment()
  {
    return $this->hasMany(Equipment::class);
  }
}
