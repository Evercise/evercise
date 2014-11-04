<div class="cover-select">
    <div class="img-uploader row">
        <div class="col-sm-12">
            {{ Form::label('image', 'Add a Cover Image', ['class' => 'mb15'] )  }}
        </div>
        <div class="col-sm-12 mb20">
            <div class="holder cover" id="cover_image" data-toggle="modal" data-target="#create-image">
                <span class="icon-block icon-lg-camera hover mt50 mb50"></span>
                <p>Min image size (H)blub pixels X (W)blub pixels - maximum file size of 2MB</p>
                <p>Formats: JPG, JPEG, PNG or GIF</p>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="image-carousel" class="carousel slide" data-interval="false">
                 <!-- Carousel items -->
                 <div class="carousel-inner">
                     <div class="item active">
                         <div class="row">
                             <div class="col-sm-4">
                                <img src="/img/example-class-img.jpg" alt="Image" class="img-responsive gallery-option" id="gallery-option-1">
                             </div>
                             <div class="col-sm-4">
                                <img src="/img/example-class-img.jpg" alt="Image" class="img-responsive gallery-option" id="gallery-option-2">
                             </div>
                             <div class="col-sm-4">
                                <img src="/img/example-class-img.jpg" alt="Image" class="img-responsive gallery-option" id="gallery-option-3">
                             </div>

                         </div>
                         <!--/row-->
                     </div>
                     <!--/item-->
                     <div class="item">
                         <div class="row">
                             <div class="col-sm-4">
                                <img src="/img/example-class-img.jpg" alt="Image" class="img-responsive gallery-option">
                             </div>
                             <div class="col-sm-4">
                                <img src="/img/example-class-img.jpg" alt="Image" class="img-responsive gallery-option">
                             </div>
                             <div class="col-sm-4">
                                <img src="/img/example-class-img.jpg" alt="Image" class="img-responsive gallery-option">
                             </div>

                         </div>
                         <!--/row-->
                     </div>
                     <!--/item-->
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
    </div>


     <div class="modal modal-cropper" id="create-image">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span class="icon icon-cross" aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <h3 class="modal-title text-center">Crop your image</h3>
              </div>
              <div class="modal-body">
                <div class="bootstrap-modal-cropper">
                    <img src="/img/example-class-img.jpg" class="img-responsive">
                </div>
              </div>
              <div class="modal-footer">
                {{ Form::open(['route' => 'home', 'method' => 'post']) }}

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {{ Form::submit('Save',['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
              </div>
            </div>
          </div>
     </div>
</div>

