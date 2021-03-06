
{{ Form::open(['id' => 'upload', 'url' => 'widgets/upload', 'files' => true, 'method' => 'post','class' => 'image-form']) }}
	<div class="formitem clearfix">
		<div class="formlabel">
			{{ Form::label( 'image', $label) }}
			{{ Form::hidden( 'label' , $label, array('id' => 'label')) }}
		</div>
		<div class="formfield">
			<div class="frame" id="frame" >
			  <div class="preview" >
			  	@if( basename($uploadImage) != 'no-user-img.jpg' && $uploadImage != null)
			  		{{ HTML::image( $uploadImage, $user->display_name.'s image', array('class'=> 'profile-pic')); }}
			  	@else
			    	{{$default_image}}
			    @endif
			  </div>

			</div>
			<div id='image-upload'>		
				<div class="cover-up">
					<span class="btn btn-blue">select file</span> 
					<div class="cover-up-wrap">
						<p>Acceptable formats : JPG, JPEG, PNG, GIF (first frame)
						<br>
						Max size 2MB</p>
					</div>
				</div>  	   
			    {{ Form::file('image', array('id'=>'image')) }}
			</div>
			<p>{{ $fieldtext}}</p>
			{{ Form::hidden( 'fieldtext' , $fieldtext, array('id' => 'fieldtext')) }}
			{{ Form::submit('Crop' , array('class'=>'btn-yellow hidden', 'id' => 'crop-save')) }}
		</div>

	</div>
{{ Form::close() }}
