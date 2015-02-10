<div class="img-uploader row">
    <div class="col-sm-12 sm-text-center">
        {{ Form::label('image', 'Upload a Profile Picture', ['class' => 'mb15'] )  }}
    </div>
    <div class="col-sm-3">
        <div class="row mb20" id="image-cropper">
            <div class="holder profile center-block" id="cover_image">
                @if(isset($image))
                    {{ image( $image , 'profile image', ['class' => 'img-responsive', 'id' => 'uploaded-image']) }}
                @endif
                {{ Form::open(['method' => 'post', 'id' => 'image-upload-form' ]) }}
                {{ Form::close() }}
            </div>
            <div class="modal modal-cropper in" id="create-image" data-backdrop="static" data-ratio="1">
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
                        {{ Form::open(['route' => 'ajax.upload.profile', 'enctype' => 'multipart/form-data' , 'method' => 'post', 'id' => 'cropped-image']) }}
                            {{ Form::file('file', ['class' => 'opacity', 'accept'=>'image/x-png, image/gif, image/jpeg' ]) }}
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
    <div class="col-sm-9 mt25 sm-text-center">
        <button id="image-select" type="button" class="image-select btn btn-primary mb20 sm-btn-block">Select an Image</button>
        {{ Form::open(['route' => 'ajax.upload.basic', 'method' => 'post', 'id' => 'no-file-reader-form']) }}
            {{ Form::file('file', ['id' => 'get_file_content', 'accept'=>'image/x-png, image/gif, image/jpeg' ]) }}
        {{ Form::close() }}
        <p>Image must be a JPG, JPEG, PNG or GIF with a maximum file size of 10MB</p>

    </div>
</div>


