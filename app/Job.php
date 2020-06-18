<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * Fillable fields.
     *
     * @var array
     */
    public $fillable = [
        'title',
        'email',
        'description',
        'user_id',
        'token'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
