<div class="modal fade" id="create-venue" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon icon-cross" aria-hidden="true"></span><span class="sr-only">Close</span></button>
        <h3 class="modal-title text-center">Create a Class</h3>
        <ul class="nav nav-pills nav-justified mt30">
          <li class="active"><a data-toggle="pill" href="#venue-tab">Venue</a></li>
          <li><a href="#facilities" data-toggle="pill">Facilities</a></li>
          <li><a href="#amenities" data-toggle="pill">Amenities</a></li>
        </ul>
      </div>
      <div class="modal-body">
        {{ Form::open(['url' => '', 'method' => 'post', 'class'=>'', 'role' => 'form'] ) }}
            <div class="tab-content">
              <div class="tab-pane active" id="venue-tab">
                   <div class="form-group mb50">
                     {{ Form::label('venue_name', 'Add a new venue', ['class' => 'mb15'] )  }}
                     {{ Form::text('venue_name', null, ['class' => 'form-control mb20', 'placeholder' => 'Venue Name']) }}
                     {{ Form::text('venue_street', null, ['class' => 'form-control mb20', 'placeholder' => 'Street Name and Number']) }}
                     <div class="row">
                        <div class="col-sm-6 text-right">
                            {{ Form::text('venue_city', null, ['class' => 'form-control mb20', 'placeholder' => 'City']) }}
                        </div>
                        <div class="col-sm-6">
                            {{ Form::text('venue_post_code', null, ['class' => 'form-control mb20', 'placeholder' => 'Postal Code']) }}
                        </div>
                     </div>
                     <div class="text-center">
                        <button class="btn btn-primary">Save Venue</button>
                     </div>
                   </div>
              </div>
              <div class="tab-pane" id="facilities">
                   <div class="form-group mb50">
                     {{ Form::label('facilities', 'What Facilities does this venue have?', ['class' => 'mb15'] )  }}
                     <div class="row">
                        <div class="col-sm-4">
                             <label class="custom-checkbox text-grey">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                        </div>
                        <div class="col-sm-4">
                             <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                        </div>
                        <div class="col-sm-4">
                             <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                        </div>
                        <div class="col-sm-4">
                             <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                        </div>
                        <div class="col-sm-4">
                             <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                        </div>
                        <div class="col-sm-4">
                             <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                        </div>
                        <div class="col-sm-4">
                             <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                        </div>
                        <div class="col-sm-4">
                             <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                        </div>
                        <div class="col-sm-4">
                             <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                        </div>
                     </div>


                   </div>
                   <div class="text-center">
                        <button class="btn btn-primary">Save Facilities</button>
                   </div>
              </div>
              <div class="tab-pane" id="amenities">
                <div class="form-group mb50">
                 {{ Form::label('amenities', 'What Amenities does this venue have?', ['class' => 'mb15'] )  }}
                 <div class="row">
                    <div class="col-sm-4">
                         <label class="custom-checkbox text-grey">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                    </div>
                    <div class="col-sm-4">
                         <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                    </div>
                    <div class="col-sm-4">
                         <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                    </div>
                    <div class="col-sm-4">
                         <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                    </div>
                    <div class="col-sm-4">
                         <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                    </div>
                    <div class="col-sm-4">
                         <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                    </div>
                    <div class="col-sm-4">
                         <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                    </div>
                    <div class="col-sm-4">
                         <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                    </div>
                    <div class="col-sm-4">
                         <label class="custom-checkbox">{{ Form::checkbox('pool', 'pool', false ) }}Swimming Pool</label>
                    </div>
                 </div>
               </div>
               <div class="text-center">
                    <button class="btn btn-primary">Save Amenities and Finish</button>
               </div>
              </div>
            </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>