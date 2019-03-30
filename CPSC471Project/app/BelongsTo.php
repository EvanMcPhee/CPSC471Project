<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BelongsTo extends Model
{
  protected $fillable = [
      'teamid', 'username',
  ];
}
