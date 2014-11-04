<?php

class City extends Eloquent {

    protected $table = 'city';

    //columns that can be updated
    protected $fillable = array('name','lat','lng');

    //columns that can't be updated after assignment
    protected $guarded = array('id');


}
