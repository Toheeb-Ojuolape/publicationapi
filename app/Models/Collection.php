<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'price',
        'balance',
        'author',
        'email',
        'filetype',
        'photoURL',
        'rating' ,
        'readers',
        'percentage',
        'description',
        'bookcover',
        'date',
        'downloadable',
        'book',
        'timestamp',
        'earnings',
        'slug',
        'currency',
        'coauthor',
        'category',
        'status'
    ];

    public function contributors()
    {
        return $this->hasMany('App\Models\Contributor');
    }

    public function myreaders()
    {
        return $this->hasMany('App\Models\Readers');
    }
}
