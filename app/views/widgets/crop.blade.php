
<div id='img-crop'>
	<img src='' alt='cropped-image'></img>

	{{ Form::hidden( 'pos_x' , 0, array('id' => 'pos_x')) }}
	{{ Form::hidden( 'pos_y' , 0, array('id' => 'pos_y')) }}
	{{ Form::hidden( 'width' , 500, array('id' => 'width')) }}
	{{ Form::hidden( 'height' , 500, array('id' => 'height')) }}
	{{ Form::hidden( 'img_url' , null, array('id' => 'img_url')) }}
	{{ Form::hidden( 'img_height' , 500, array('id' => 'img_height')) }}

	{{ Form::submit('Save' , array('class'=>'btn-yellow')) }}
        
</div>
