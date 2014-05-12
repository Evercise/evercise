@if( basename($uploadImage) != 'no-user-img.jpg' && $uploadImage != null)
{{ Form::open(['id' => 'upload', 'url' => 'widgets/upload', 'files' => true, 'method' => 'post','class' => 'create-form']) }}
	<div class="formitem clearfix">
		<div class="formlabel">

			{{ Form::label( 'image', $label) }}
			{{ Form::hidden( 'label' , $label, array('id' => 'label')) }}
		</div>
		<div class="formfield">
			<div class="frame" >
			  <div class="preview" >
			  	{{ HTML::image( $uploadImage, $displayName.'s image', array('class'=> 'profile-pic')); }}
			  </div>
			</div>
			<div id='image-upload'>		
				<div class="cover-up">
					<span class="btn btn-blue">select file</span> 
					<div class="cover-up-wrap">
						<p>Accepted formats: JPG,JPEG,PNG,BMP</p>
					</div>
				</div>  	   
			    {{ Form::file('image', array('id'=>'image')) }}	 

			</div>
			<p>{{ $fieldtext}}</p>
			{{ Form::hidden( 'fieldtext' , $fieldtext, array('id' => 'fieldtext')) }}
		</div>
	</div>
{{ Form::close() }}

@else

{{ Form::open(['id' => 'upload', 'url' => 'widgets/upload', 'files' => true, 'method' => 'post','class' => 'create-form']) }}
	<div class="formitem clearfix">
		<div class="formlabel">
			{{ Form::label( 'image', $label) }}
			{{ Form::hidden( 'label' , $label, array('id' => 'label')) }}
		</div>
		<div class="formfield">
			<div class="frame" >
			  <div class="preview" >
			    <img src="/img/add_users.png" alt="preview image">
			  </div>
			</div>
			<div id='image-upload'>		
				<div class="cover-up">
					<span class="btn btn-blue">select file</span> 
					<div class="cover-up-wrap">
						<p>Accepted formats: JPG,JPEG,PNG,BMP</p>
					</div>
				</div>  	   
			    {{ Form::file('image', array('id'=>'image')) }}	 

			</div>
			<p>{{ $fieldtext}}</p>
			{{ Form::hidden( 'fieldtext' , $fieldtext, array('id' => 'fieldtext')) }}
		</div>
	</div>
{{ Form::close() }}


@endif





