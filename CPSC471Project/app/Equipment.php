<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
  protected $fillable = [
      'name', 'price', 'leagueid',
  ];

  public function league()
  {
    return $this->belongsTo(League::class);
  }
}
