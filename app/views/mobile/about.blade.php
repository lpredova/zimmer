@extends('master')

@section('content')
    <div class="mobile-body">
        <div class="container">
            <div class="col-md-12">
                <h1 class="text-center">About</h1>

                <p>Zimmer Frei is web aplication that provides tourists with data like where they can find best and nearest
                    place to stay.
                    It's suited for tourists,explorers and anyone that feels like it.</p>

                <p>This project started in October 2014 within class "Analiza i Razvoj programskih proizvoda"
                    on Faculty of Organization and Informatics in Varaždin,UNIZG.</p>

                <div class="text-center margin-top">
                    <h3>Contributors</h3></div>

                <div class="col-lg-3">
                    <h2 class="text-center">Luka Klancir</h2>
                    <img class="img-circle team-photo team-photo-mobile" src="/assets/images/klancir.jpg">
                    <h4 class="text-center">Project manager &amp; Windows phone developer</h4>
                </div>

                <div class="col-lg-3">
                    <h2 class="text-center">Andro Krezić</h2>
                    <img class="img-circle team-photo team-photo-mobile"
                         src="/assets/images//andro.jpeg">
                    <h4 class="text-center">Android developer</h4>
                </div>

                <div class="col-lg-3">
                    <h2 class="text-center">Petar Vrbek</h2>
                    <img class="img-circle team-photo team-photo-mobile" src="/assets/images/pero.jpg">
                    <h4 class="text-center">
                        Mobile &amp; Web designer &amp; UX designer
                    </h4>
                </div>

                <div class="col-lg-3">
                    <h2 class="text-center">Lovro Predovan</h2>
                    <img class="img-circle team-photo team-photo-mobile" src="/assets/images/loce.jpg">
                    <h4 class="text-center">
                        Backend and frontend web developer &amp; database designer
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center margin-top margin-bottom">
                    <p>Contact:<br><a href="#">zimmerfrei.co/contact</a></p>
                    <ul class="list-unstyled margin-bottom">
                        <li><i class="fa fa-phone fa-fw"></i> 01/3013-058</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:vcz@vcz.hr">zimmer@frei.co</a>
                        </li>
                    </ul>
                    <br>
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