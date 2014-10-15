<div class="container-fluid bg-grey">
    <div class="container">
        <div class="underline text-center">
            <h1>Upcoming Classes</h1>
        </div>
        <div id="masonry" class="row masonry">
            <div class="col-md-6 masonry-item">
                @include('v3.classes.class_panel', ['show' => 'upcoming-session'])
            </div>
            <div class="col-md-6 masonry-item">
                @include('v3.classes.class_panel', ['show' => 'upcoming-session'])
            </div>
        </div>
    </div>
</div>
