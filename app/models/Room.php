<?php

class Room extends Eloquent {

    protected $table = 'rooms';

    //columns that can be updated
    protected $fillable = array('name','capacity','description');

    //columns that can't be updated after assignment
    protected $guarded = array('id');


    public function apartment()
    {
        return $this->belongsTo('Apartment');
    }

}
