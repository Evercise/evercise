<div class="img-uploader row">
    <div class="col-sm-12">
        {{ Form::label('image', 'Upload a Profile Picture', ['class' => 'mb15'] )  }}
    </div>
    <div class="col-sm-3">
        <div class="image-placeholder">
            <img data-src="holder.js/130x130/upload" class="img-thumbnail">
        </div>
    </div>
    <div class="col-sm-9 mt25">
        <button class="btn btn-primary mb20">Select an Image</button>
        <p>Image must be a JPG, JPEG, PNG or GIF with a maximum file size of 2MB</p>
    </div>
</div>
