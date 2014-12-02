<?php


class Apartment extends Eloquent {

    protected $table = 'apartments';


    //columns that can't be updated after assignment
    protected $guarded = array('id','owner_id');


    public function picture()
    {
        return $this->hasMany('Picture');
    }

    public function room()
    {
        return $this->hasMany('Room');
    }

    public function fitting()
    {
        return $this->hasMany('Fitting');
    }

    public function user()
    {
        return $this->belongsTo('User','owner_id');
    }

    public function city(){
        return $this->belongsTo('City');
    }

    public function type(){
        return $this->belongsTo('ApartmentType');
    }



    /**
     * Methods for getting specific parameters
     */


}
