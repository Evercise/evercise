@extends('v3.layouts.master')
<?php View::share('og', $og) ?>
@section('body')
    <div class="hero no-nav-change" style="background-image: url('{{url()}}/profiles/{{$trainer->user->directory}}/{{$evercisegroup->image}}')">
        <nav class="navbar navbar-inverse nav-bar-bottom" role="navigation">
          <div class="container">
              <ul class="nav navbar-nav nav-justified nav-no-float">
                <li class="active"><a href="#about">About</a></li>
                <li><a href="#schedule">Schedule</a></li>
                <li><a href="#facilities">Facilities & Amenities</a></li>
                <li><a href="#reviews">Reviews</a></li>
                <li class="text-center">
                    <span>
                        <a href="#"><span class="icon icon-fb mr20 hover"></span> </a>
                        <a href="#"><span class="icon icon-twitter mr20 hover"></span> </a>
                        <a href="#"><span class="icon icon-google hover"></span> </a>
                    </span>

                </li>
              </ul>
          </div>
        </nav>
    </div>
    <div class="container mt30">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="mb5">{{ $evercisegroup->name }}</h1>
                <div class="mb30">
                    <span class="icon icon-full-star"></span>
                    <span class="icon icon-full-star"></span>
                    <span class="icon icon-full-star"></span>
                    <span class="icon icon-empty-star"></span>
                    <span class="icon icon-empty-star"></span>
                </div>

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibu</p>
                <div class="row">
                    <div class="col-sm-11">
                        <div class="row mt20">
                            <div class="col-sm-3">
                                <img src="/img/lewis.jpg" alt="profile picture" class="img-responsive img-circle">
                            </div>
                            <div class="col-sm-9 mt25">
                                <div class="condensed">
                                    <strong>This class is presented by</strong>
                                </div>
                                <span>Lodon Yoga</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-sm-6">
                <h1 class="mb5">Location</h1>
                <span><span class="icon icon-pink-pointer"></span> The Box, 3 nugent terrance, london nw8 9qd</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-10">
                <h1>Upcoming sessions</h1>
            </div>

            <div class="col-sm-2 mt20">
               <div class="input-group">
                  <span class="input-group-addon ">
                       <span class="icon icon-calendar ml5 mr5"></span>
                  </span>
                  <div class="custom-select">
                     {{ Form::select('date',
                         [
                             '01' => 'January',
                             '02' => 'Febuary',
                         ]
                      , '01', ['class' => 'form-control input-sm no-border-left custom-select'] ) }}
                  </div>
               </div>
            </div>
            <div class="carousel-table col-sm-12">

                <div class="carousel-table-control left-control"></div>

                <div class="carousel-table-inner">
                    <ul class="nav navbar-nav nav-justified text-center nav-no-float nav-carousel" role="tablist">
                        <li class="active"><a href="#"><div class="condensed">MON</div>Sept 27</a></li>
                        <li><a href="#"><div class="condensed">TUE</div>Sept 28</a></li>
                        <li><a href="#"><div class="condensed">WED</div>Sept 29</a></li>
                        <li><a href="#"><div class="condensed">THU</div>Sept 30</a></li>
                        <li><a href="#"><div class="condensed">FRI</div>Sept 31</a></li>
                        <li><a href="#"><div class="condensed">SAT</div>Oct 01</a></li>
                        <li><a href="#"><div class="condensed">SUN</div>Oct 02</a></li>
                    </ul>

                    <div class="table-responsive center-block">
                        <table class="table table-hover pull-left">
                            <tbody>
                                <tr>
                                    <td class="text-left"><span class="icon icon-clock mr5"></span><span>10am - 11am</span></td>
                                    <td class="text-center"><span class="icon icon-ticket mr10"></span><span>x 8 tickets left</span></td>
                                    <td class="text-center"><span class="icon icon-watch mr5"></span><span>1 hour</span></td>
                                    <td class="text-right">
                                        <span>
                                            <strong class="text-primary mr25 lead">&pound;16</strong>
                                        </span>

                                        <div class="btn-group">
                                          <button type="button" class="btn btn-primary">JOIN CLASS</button>
                                          <select class="btn btn-primary btn-select">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                          </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left"><span class="icon icon-clock mr5"></span><span>10am - 11am</span></td>
                                    <td class="text-center"><span class="icon icon-ticket mr10"></span><span>x 8 tickets left</span></td>
                                    <td class="text-center"><span class="icon icon-watch mr5"></span><span>1 hour</span></td>
                                    <td class="text-right">
                                        <span>
                                            <strong class="text-primary mr25 lead">&pound;16</strong>
                                        </span>

                                        <div class="btn-group">
                                          <button type="button" class="btn btn-primary">JOIN CLASS</button>
                                          <select class="btn btn-primary btn-select">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                          </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left"><span class="icon icon-clock mr5"></span><span>10am - 11am</span></td>
                                    <td class="text-center"><span class="icon icon-ticket mr10"></span><span>x 8 tickets left</span></td>
                                    <td class="text-center"><span class="icon icon-watch mr5"></span><span>1 hour</span></td>
                                    <td class="text-right">
                                        <span>
                                            <strong class="text-primary mr25 lead">&pound;16</strong>
                                        </span>

                                        <div class="btn-group">
                                          <button type="button" class="btn btn-primary">JOIN CLASS</button>
                                          <select class="btn btn-primary btn-select">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                          </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left"><span class="icon icon-clock mr5"></span><span>10am - 11am</span></td>
                                    <td class="text-center"><span class="icon icon-ticket mr10"></span><span>x 8 tickets left</span></td>
                                    <td class="text-center"><span class="icon icon-watch mr5"></span><span>1 hour</span></td>
                                    <td class="text-right">
                                        <span>
                                            <strong class="text-primary mr25 lead">&pound;16</strong>
                                        </span>

                                        <div class="btn-group">
                                          <button type="button" class="btn btn-default">SOLD OUT</button>
                                          <select class="btn btn-default btn-select">
                                            <option>0</option>
                                          </select>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end table inner -->

                <div class="carousel-table-control right-control"></div>


            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>Venue Facilities</h1>
                </div>

                <ul class="row custom-list">
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                </ul>

                <div class="page-header">
                    <h1>Venue Amenties</h1>
                </div>
                <ul class="row custom-list">
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                    <li class="col-sm-3">Cardio Machines</li>
                </ul>


            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>Reviews</h1>
                </div>
            </div>
            <div class="col-sm-6">
                @include('v3.users.rating_block')
            </div>
            <div class="col-sm-6">
                 @include('v3.users.rating_block')
            </div>
            <div class="col-sm-6">
                 @include('v3.users.rating_block')
            </div>
            <div class="col-sm-6">
                 @include('v3.users.rating_block')
            </div>
        </div>
    </div>
@stop