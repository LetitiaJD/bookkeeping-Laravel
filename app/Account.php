<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_type', 'account_holder',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    protected $table = 'account';

    protected $primaryKey = 'account_id';

    public function entry(){
        return $this->hasOne('App\Entry', 'account_id');
    }

    /**
     * The users that belong to the accounts.
     */
    public function users(){
        return $this->belongsToMany('App\User', 'account_user', 'account_id', 'user_id');
    }
}
