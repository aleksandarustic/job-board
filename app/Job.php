<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Job
 */
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


    /**
     * user: Represent a relation to user model
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
