<?php

class UserFavorite extends Eloquent {

    protected $table = 'user_favorites';

    //columns that can be updated
    protected $fillable = array('title','description');

    //columns that can't be updated after assignment
    protected $guarded = array('id','user_id','apartment_id');

    public function apartment(){
        return $this->belongsTo('Apartment');
    }

    public function user(){
        return $this->belongsTo('Users');
    }



}
