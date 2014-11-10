<div class="cover-select">
    <div class="img-uploader row">
        <div class="col-sm-12">
            {{ Form::label('image', 'Add a Cover Image', ['class' => 'mb15'] )  }}
        </div>
        <div class="col-sm-12 mb20" id="image-cropper">
            <div class="holder cover" id="cover_image">
                {{ Form::open(['route' => 'home', 'method' => 'post', 'id' => 'image-upload-form' ]) }}
                    <button id="cover-remove" type="button" class="btn btn-danger hidden btn-remove">remove</button>
                    <div class="row">
                        <div class="text-center col-sm-12 mt50">
                            <span id="image-select" class="icon-block icon-lg-camera hover mb40"></span>
                            <p>Click to icon above to upload your own image or alternatively choose from the selection below</p>
                            <p>Maximum file size of 2MB</p>
                            <p>Formats: JPG, JPEG, PNG or GIF</p>
                        </div>
                    </div>
                {{ Form::close() }}
                </div>
                <div class="modal modal-cropper" id="create-image" data-backdrop="static">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span class="icon icon-cross" aria-hidden="true"></span><span class="sr-only">Close</span></button>
                            <h3 class="modal-title text-center">Crop your image</h3>
                          </div>
                          <div class="modal-body">
                            <div class="bootstrap-modal-cropper">
                                <img src="" id="uploaded-image" class="img-responsive">
                            </div>
                          </div>
                          <div class="modal-footer">
                            {{ Form::open(['route' => 'ajax.upload.cover', 'enctype' => 'multipart/form-data' , 'method' => 'post', 'id' => 'cropped-image']) }}
                                {{ Form::file('file', ['class' => 'hidden']) }}
                                {{ Form::hidden('x',null) }}
                                {{ Form::hidden('y',null) }}
                                {{ Form::hidden('width',null) }}
                                {{ Form::hidden('height',null) }}
                                {{ Form::hidden('box_width',null) }}
                                {{ Form::hidden('box_height',null) }}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                {{ Form::submit('Save',['class' => 'btn btn-primary']) }}

                            {{ Form::close() }}
                          </div>
                        </div>
                      </div>
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



</div>

