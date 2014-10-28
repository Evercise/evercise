@extends('v3.layouts.master')
<?php View::share('og', $data['og']) ?>
@section('body')
    <div class="hero no-nav-change" style="background-image: url('{{url()}}/profiles/{{$data['trainer']->user->directory.'/'.$data['evercisegroup']->image}}')">
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
                <h1 class="mb5">{{ $data['evercisegroup']->name }}</h1>
                <div class="mb30">
                    <span class="icon icon-full-star"></span>
                    <span class="icon icon-full-star"></span>
                    <span class="icon icon-full-star"></span>
                    <span class="icon icon-empty-star"></span>
                    <span class="icon icon-empty-star"></span>
                </div>

                <p>{{ $data['evercisegroup']->description }}</p>
                <div class="row">
                    <div class="col-sm-11">
                        <div class="row mt20">
                            <div class="col-sm-3">
                                <img src="{{url()}}/profiles/{{$data['trainer']->user->directory.'/'.$data['trainer']->user->image}}" alt="profile picture" class="img-responsive img-circle">
                            </div>
                            <div class="col-sm-9 mt25">
                                <div class="condensed">
                                    <strong>This class is presented by</strong>
                                </div>
                                <span>{{ $data['trainer']->user->display_name }}</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-sm-6">
                <h1 class="mb5">Location</h1>
                <span><span class="icon icon-pink-pointer"></span>{{ $data['venue']->address }}</span>
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
                            @foreach($data['evercisegroup']->futuresessions as $futuresession)
                                <tr>
                                    <td class="text-left"><span class="icon icon-clock mr5"></span><span>{{ (date('h:ia' , strtotime($futuresession->date_time))) .' - '. (date('h:ia' , strtotime($futuresession->date_time) + ( $futuresession->duration * 60))) }}</span></td>
                                    <td class="text-center"><span class="icon icon-ticket mr10"></span><span>x {{ $data['evercisegroup']->capacity -  $data['members'][$futuresession->id] }} tickets left</span></td>
                                    <td class="text-center"><span class="icon icon-watch mr5"></span><span>{{ $futuresession->formattedDuration() }}</span></td>
                                    <td class="text-right">
                                        <span>
                                            <strong class="text-primary mr25 lead">&pound;{{ $futuresession->price }} </strong>
                                        </span>

                                        <div class="btn-group">
                                          <button type="button" class="btn btn-primary">JOIN CLASS</button>
                                          <select class="btn btn-primary btn-select">
                                            @for($i=0; $i<($data['evercisegroup']->capacity - $data['members'][$futuresession->id] + 1 ); $i++)
                                            <option>{{$i}}</option>
                                            @endfor
                                          </select>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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
                @if(count($data['venue']->facilities) > 0)
                <div class="page-header">
                    <h1>Venue Facilities</h1>
                </div>

                <ul class="row custom-list">
                    @foreach($data['venue']->facilities as $key => $facility)
						@if ($facility->category == 'facility')
							<li>{{ $facility->name}}</li>
						@endif
					@endforeach
                </ul>
                @endif

                @if(count($data['venue']->facilities) > 0)
                <div class="page-header">
                    <h1>Venue Amenties</h1>
                </div>
                <ul class="row custom-list">
					@foreach($data['venue']->facilities as $key => $facility)
						@if ($facility->category == 'Amenity')
							<li>{{ $facility->name}}</li>
						@endif
					@endforeach
                </ul>
                @endif


            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>Reviews</h1>
                </div>
            </div>
            @foreach ($data['allRatings'] as $rating)
                <div class="col-sm-6">
                    @include('v3.users.rating_block')
                </div>
            @endforeach
        </div>
    </div>
@stop