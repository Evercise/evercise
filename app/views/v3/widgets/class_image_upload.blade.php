<div class="img-uploader row">
    <div class="col-sm-12">
        {{ Form::label('image', 'Upload a Profile Picture', ['class' => 'mb15'] )  }}
    </div>
    <div class="col-sm-12 mb20">
        <img data-src="holder.js/100%x200/upload" class="img-thumbnail">
    </div>
    <div class="col-sm-3">
        <button class="btn btn-primary btn-block mb20">Select an Image</button>
    </div>
    <div class="col-sm-9 mt5">
        <i>Image must be a JPG, JPEG, PNG or GIF with a maximum file size of 2MB</i>
    </div>
</div>
