<?php

class Booking extends Eloquent {

    protected $table = 'bookings';

    //columns that can be updated
    protected $fillable = array('booking_start','booking_end','notice');

    //columns that can't be updated after assignment
    protected $guarded = array('id','apartment_id','room_id');

}
