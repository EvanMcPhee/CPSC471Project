<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
  protected $fillable = [
      'name', 'description', 'rules',
  ];

  public function league()
  {
    return $this->hasMany(League::class);
  }

  public function game()
  {
    return $this->belongsTo(Game::class);
  }

}
