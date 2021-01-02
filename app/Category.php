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
    public $fillable = [
        'mod_id', 'mod_name', 'mod_parent',
    ];

    protected $table = 'tbmodule';

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
        return $this->hasMany('App\Category','mod_parent','mod_id') ;
    }
}
