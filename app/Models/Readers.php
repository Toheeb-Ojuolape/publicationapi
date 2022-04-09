<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Readers extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid','id','currency','title', 'bookcover','author','email','name','readerPhoto',
        'filetype','photoURL','slug','description','category',
        'book','price','rating','collection_id'
    ];

    
}
