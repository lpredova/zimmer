<?php

class Picture extends Eloquent {

    protected $table = 'pictures';

    //columns that can be updated
    protected $fillable = array('title','url');

    //columns that can't be updated after assignment
    protected $guarded = array('id','apartment_id');

    public function apartment()
    {
        return $this->belongsTo('Apartment');
    }


}
