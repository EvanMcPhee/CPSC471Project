<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [
      'sender', 'reciever', 'content',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
