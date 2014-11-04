<?php

class Country extends Eloquent {

    protected $table = 'country';

    //columns that can be updated
    protected $fillable = array('name');

    //columns that can't be updated after assignment
    protected $guarded = array('id');

}
