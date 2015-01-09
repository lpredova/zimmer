<?php


class Apartment extends Eloquent {

    protected $table = 'apartments';

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

    public function ratings()
    {
        return $this->hasMany('UserRating');
    }

    public function favorites()
    {
        return $this->hasMany('UserFavorite');
    }

}
