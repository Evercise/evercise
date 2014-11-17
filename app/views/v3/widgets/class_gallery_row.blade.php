<div class="col-sm-12">

    <div id="image-carousel" class="carousel slide" data-interval="false">
         <input type="hidden" value="" id="gallery-input">
         <!-- Carousel items -->
         <div class="carousel-inner gallery-items">

            @if(isset($gallery))
                @foreach($gallery as $index => $gal)
                    @if($index % 2 === 0)
                        {{ $index > 0 ? '</div></div>' : null }}
                        <div class="item {{ $index === 0 ? 'active' : null }}">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="holder gallery-img-wrapper" id="first-img">
                                        <div class="row">
                                            <div class="text-center col-sm-12 mt10">
                                                <span class="image-select icon-lg icon-md-camera hover"></span>
                                                <p>Add an image</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    @endif
                                 <div class="col-sm-4">
                                    <div class="holder gallery-img-wrapper">
                                        <img src="/img/gallery/thumb_{{$gal['image']}}" alt="{{ $gal['keywords'] }}" class="img-responsive gallery-option" id="gallery-option-{{ $index }}">
                                    </div>
                                 </div>

                    @if($index == count($gallery) -1 )
                            </div>
                        </div>
                    @endif
                @endforeach

            @else
            <div class="item active">
                <div class="row">
                     <div class="col-sm-4">
                        <div class="holder gallery-img-wrapper" id="first-img">
                            <div class="row">
                                <div class="text-center col-sm-12 mt10">
                                    <span class="image-select icon-lg icon-md-camera hover"></span>
                                    <p>Add an image</p>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="holder gallery-img-wrapper">
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="holder gallery-img-wrapper">
                        </div>
                     </div>
                </div>
                <!--/row-->
            </div>
            @endif




         </div>
         <!--/carousel-inner-->
         <a class="left carousel-control" href="#image-carousel" data-slide="prev">
            <span class="icon icon-left-triangle"></span>
         </a>

         <a class="right carousel-control" href="#image-carousel" data-slide="next">
            <span class="icon icon-right-triangle"></span>
         </a>
    </div>
     <!--/myCarousel-->
</div>