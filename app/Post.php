<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table name

    protected $table = 'posts';

    //Table primary key
    public $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\User');
    }


}
