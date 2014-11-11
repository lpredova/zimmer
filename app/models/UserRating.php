<?php

class UserRating extends Eloquent {

    protected $table = 'user_ratings';

    //columns that can be updated
    protected $fillable = array('rating','comment');

    //columns that can't be updated after assignment
    protected $guarded = array('id','user_id','apartment_id');

}
