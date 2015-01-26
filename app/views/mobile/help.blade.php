@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="text-center">Help <i class="fa fa-exclamation"></i></h1>

                <p class="text-center">
                    ZimmerFrei is an mobile application whose principal goal is to provide its users a simple “last
                    minute” overview of accommodation in a desired area. The application has also a web counterpart
                    which serves the same purpose but with extend fucntionalites for accomodation providers to list
                    their apartments and rooms on the whole service.</p>
                <img class="text-center img-responsive mobile-photo"
                     src="/assets/images/mobile_screenshots/Home.png">

                <h2 class="text-center">How to use ZimmerFrei<i class="fa fa-question"></i></h2>

                <p class="text-center">Zimmer Frei is mobile app for explorers, accomodation seekers and new generation
                    of tourists.</p>


                <h3 class="text-center">Search apartments <i class="fa fa-exclamation"></i></h3>

                <p class="text-center">
                    With Zimmer Frei you can browse list of apartments,search trough map and find <b>best</b>
                    acoomodation !

                <p>
                    <img class="text-center img-responsive mobile-photo"
                         src="/assets/images/mobile_screenshots/NearMeList.png">

                <h3 class="text-center">Explore<i class="fa fa-exclamation"></i></h3>
                <img class="text-center img-responsive mobile-photo"
                     src="/assets/images/mobile_screenshots/Map.png">

                <p class="text-center">You can browse trough map freely, and search for new places.</p>


                <h3 class="text-center">Save favorites <i class="fa fa-exclamation"></i></h3>

                <p class="text-center">You found a great place to stay ? Bookmark it !</p>
                <img class="text-center img-responsive mobile-photo"
                     src="/assets/images/mobile_screenshots/MyPlaces.png">


                <h3 class="text-center"> Sign up
                    <i class="fa fa-user"></i></h3>

                <p class="text-center">Register and edit your profile</p>

                <img class="text-center img-responsive mobile-photo"
                     src="/assets/images/mobile_screenshots/Signin.png">


                <img class="text-center img-responsive mobile-photo"
                     src="/assets/images/mobile_screenshots/Registration.png">


                <img class="text-center img-responsive mobile-photo"
                     src="/assets/images/mobile_screenshots/Profile.png">


                <h3 class="text-center">Report problem</h3>

                <div class="col-lg-3">
                    <h4 class="text-center">
                        <ul class="text-center list-no-decoration">
                            <li><a href="mailto:krezic@foi.hr"> akrezic@foi.hr</a>
                            </li>
                            <li><a href="mailto:lpredova@foi.hr"> lpredova@foi.hr</a>
                            </li>
                            <li><a href="mailto:pvrbek@foi.hr"> pvrbek@foi.hr</a>
                            </li>
                            <li><a href="mailto:lklancir@foi.hr"> lklancir@foi.hr</a>
                            </li>
                        </ul>
                    </h4>
                </div>


                </p>
            </div>
        </div>
    </div>
    <!--Footer-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-1 text-center margin-top margin-bottom">
                    <p>Contact:<a href="#">zimmerfrei.co/contact</a></p>
                    <ul class="list-unstyled margin-bottom">
                        <li><i class="fa fa-phone fa-fw"></i> 01/3013-058</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i> <a href="mailto:vcz@vcz.hr">zimmer@frei.co</a>
                        </li>
                    </ul>

                    <ul class="list-inline">
                        <li>
                            <a href="#">
                                <img src="/assets/images/logo_mini.png" alt="" id="logo">
                            </a>
                        </li>
                    </ul>
                    <p class="text-muted margin-bottom">
                        <a href="#">zimmerfrei.co</a>
                    </p>

                    <p>LP 2015</p>
                </div>
            </div>
        </div>
    </footer>
    <!--End footer-->

@stop