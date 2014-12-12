<div class="container-fluid bg-grey">
    <div class="container">
        <div class="underline text-center">
            <h1>Upcoming Classes</h1>
        </div>
        <div id="masonry" class="row masonry">
           @if(isset($sessions) ? (count($sessions) ? true : false ) : false )
               @foreach($sessions as $session)
                    <div class="col-md-6 masonry-item">
                        @include('v3.classes.class_panel')
                    </div>
                @endforeach
            @else
              <div class="col-sm-12 text-center mb40">
                  <strong>Hey <span class="text-primary">{{ $user->display_name }}</span> You currently have no upcoming classes!</strong>
              </div>
            @endif
        </div>
    </div>
</div>
