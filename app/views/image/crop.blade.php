
<div id='img-crop'>
	<img src='' alt='cropped-image'></img>
    {{ Form::open(['id' => 'crop', 'url' => 'image/crop', 'method' => 'post']) }}

		{{ Form::hidden( 'pos_x' , null, array('id' => 'pos_x')) }}
		{{ Form::hidden( 'pos_y' , null, array('id' => 'pos_y')) }}
		{{ Form::hidden( 'width' , null, array('id' => 'width')) }}
		{{ Form::hidden( 'height' , null, array('id' => 'height')) }}
		{{ Form::hidden( 'img_url' , null, array('id' => 'img_url')) }}
		{{ Form::hidden( 'img_height' , null, array('id' => 'img_height')) }}

		{{ Form::submit('Save' , array('class'=>'btn-yellow ')) }}
            
    {{ Form::close() }}
</div>
