<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','photoURL','balance','file','collection_id'
    ];

    public function collections()
    {
      return $this->belongsTo('App\Models\Collection');
    }
}
