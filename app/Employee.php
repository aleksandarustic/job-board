<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['firstname', 'lastname', 'phone','company','email'];

    public function employee_company(){
        return $this->belongsTo('App\Company','company');
    }
}
