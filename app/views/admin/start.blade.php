@extends('admin.index')
@section('adminContent')

                    <div class="row">
                        <div class="col-lg-4 col-xs-6">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        {{$apartments}}
                                    </h3>
                                    <p>
                                        Total apartments
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="/zimmer-frei/public/admin/apartments" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        {{$bookings}}
                                    </h3>
                                    <p>
                                        Total bookings
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-6">
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        {{$users}}
                                    </h3>
                                    <p>
                                        User Registrations
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="/zimmer-frei/public/admin/users" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
@stop