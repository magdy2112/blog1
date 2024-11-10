<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory, Notifiable,SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'language',

    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getCreatedAtAttribute($val)
    {

        return Carbon::parse($val)->format('d-m-Y');
    }

}
