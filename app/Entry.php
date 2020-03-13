<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Entry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id', 'category_id', 'created_at', 'updated_at', 'entry_description', 'entry_amount',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['entry_date', 'created_at', 'updated_at'];

    protected $primaryKey = 'entry_id';

    protected $table = 'entry';

    public function account(){
        return $this->belongsTo('App\Account', 'account_id');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}
