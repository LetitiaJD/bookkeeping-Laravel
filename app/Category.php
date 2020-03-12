<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    protected $primaryKey = 'category_id';

    protected $table = 'category';

    public function entry(){
        return $this->hasOne('App\Entry', 'account_id');
    }
}
