<div class="modal fade" id="create-venue" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon icon-cross" aria-hidden="true"></span><span class="sr-only">Close</span></button>
        <h3 class="modal-title text-center">Create a Venue</h3>
        <ul class="nav nav-pills nav-justified mt30">
          <li class="active"><a id="venue-pill" data-toggle="pill" href="#venue-tab">Venue</a></li>
          <li><a id="facilities-pill" href="#facilities" data-toggle="pill">Facilities</a></li>
          <li><a id="amenities-pill" href="#amenities" data-toggle="pill">Amenities</a></li>
        </ul>
      </div>
      <div class="modal-body">
        {{ Form::open(['route' => 'venue.store', 'method' => 'post', 'id' => 'create_venue', 'class'=>'', 'role' => 'form'] ) }}
            <div class="tab-content">
              <div class="tab-pane active" id="venue-tab">
                   <div class="form-group">
                     {{ Form::label('name', 'Add a new venue', ['class' => 'mb15'] )  }}
                     {{ Form::text('name', null, ['class' => 'form-control mb20', 'placeholder' => 'Venue Name']) }}
                   </div>
                   <div class="form-group">
                     {{ Form::text('address', null, ['class' => 'form-control mb20', 'placeholder' => 'Street Name and Number']) }}
                   </div>
                     <div class="row">
                        <div class="col-sm-6 text-right">
                            <div class="form-group">
                                {{ Form::text('town', null, ['class' => 'form-control mb20', 'placeholder' => 'City']) }}
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                              {{ Form::text('postcode', null, ['class' => 'form-control mb20', 'placeholder' => 'Postal Code']) }}
                            </div>
                        </div>
                     </div>
                     <div class="text-center">
                        <button data-target="facilities" id="add_facilities"  class="btn btn-primary next">Add Facilities</button>
                     </div>
              </div>
              <div class="tab-pane" id="facilities">
                   <div class="form-group mb50">
                     {{ Form::label('facilities', 'What Facilities does this venue have?', ['class' => 'mb15'] )  }}
                     <div class="row">
                        @foreach($facilities['facilities'] as $key => $facility)
                            <div class="col-sm-6 custom-checkbox">

                                    {{ Form::checkbox('facilities_array[]', $key, false, ['id' => $key.'-id'] ) }}
                                    <label for="{{$key}}-id" class="text-grey">{{ $facility }}</label>

                                <!--
                                <label class="custom-checkbox text-grey">{{ Form::checkbox('facilities_array[]', $key, false ) }}{{ $facility }}</label>
                                -->
                            </div>
                        @endforeach
                     </div>
                   </div>
                   <div class="text-center">
                        <button data-target="amenities" class="btn btn-primary next" id="add_amenities">Add Amenities</button>
                   </div>
              </div>
              <div class="tab-pane" id="amenities">
                <div class="form-group mb50">
                 {{ Form::label('amenities', 'What Amenities does this venue have?', ['class' => 'mb15'] )  }}
                 <div class="row">
                    @foreach($facilities['amenities'] as $key => $amenities)
                        <div class="col-sm-6 custom-checkbox">
                            {{ Form::checkbox('facilities_array[]', $key, false, ['id' => $key.'-id'] ) }}
                            <label for="{{$key}}-id" class="text-grey">{{ $amenities }}</label>
                        <!--
                            <label class="custom-checkbox text-grey">{{ Form::checkbox('facilities_array[]', $key, false ) }}{{ $amenities }}</label>
                        -->
                        </div>
                    @endforeach
                 </div>
               </div>
               <div class="text-center">
                    {{ Form::submit('Save Amenities and Finish',['class' => 'btn btn-primary']) }}
               </div>
              </div>
            </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>