<div class="container-fluid bg-grey">
    <div class="container">
        <div class="underline text-center">
            <h1>Recent Classes</h1>
        </div>
        <div id="masonry" class="row masonry">
            <div class="col-md-6 masonry-item">
                @include('v3.classes.class_panel',['show'=>'rate-it'])
            </div>
            <div class="col-md-6 masonry-item">
                @include('v3.classes.class_panel',['show'=>'no-session'])
            </div>
            <div class="col-md-6 masonry-item">
                @include('v3.classes.class_panel',['show'=>'user-rating'])
            </div>

            <div class="col-md-6 masonry-item">
                @include('v3.classes.class_panel', ['show' => 'next-session'])
            </div>
        </div>
    </div>
</div>
