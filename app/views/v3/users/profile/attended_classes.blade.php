<div class="container-fluid bg-grey">
    <div class="container">
        <div class="underline text-center">
            <h1>Recent Classes</h1>
        </div>
        <div id="masonry" class="row masonry">
           @if(isset($sessions) ? (count($sessions) ? true : false ) : false )
               @foreach($sessions as $session)
                    <div class="col-md-6 masonry-item">
                        @include('v3.classes.class_panel',['show'=>($session->sessionmembers[0]->rating ? 'user-rating' : 'rate-it')])
                    </div>
               @endforeach
          @else
              No Classes
          @endif
        </div>
    </div>
</div>
