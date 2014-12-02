<?php

class Fitting extends Eloquent {

    protected $table = 'fittings';

    //columns that can be updated
    protected $fillable = array('name','description','icon');

    //columns that can't be updated after assignment
    protected $guarded = array('id');

    public function apartment()
    {
        return $this->belongsTo('Apartment');
    }

}
