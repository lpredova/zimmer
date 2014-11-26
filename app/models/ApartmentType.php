<?php


class ApartmentType extends Eloquent {

    protected $table = 'apartment_types';

    //columns that can be updated
    protected $fillable = array('name');

    //columns that can't be updated after assignment
    protected $guarded = array('id');


    public function apartment(){
        return $this->hasMany('Apartment');
    }
}
