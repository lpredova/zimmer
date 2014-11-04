<?php


class Apartment extends Eloquent {

    protected $table = 'apartments';

    //columns that can be updated
    //protected $fillable = array('name','name');

    //columns that can't be updated after assignment
    protected $guarded = array('id','owner_id');


}
