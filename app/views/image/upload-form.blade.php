@if( basename($uploadImage) != 'no-user-img.jpg' && $uploadImage != null)
{{ Form::open(['id' => 'upload', 'url' => 'image/upload', 'files' => true, 'method' => 'post','class' => 'create-form']) }}
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
					<span class="btn btn-fb">select file</span> 
					<div class="cover-up-wrap">
						<p>Click select a file to choose a new image.</p>
					</div>
				</div>  	   
			    {{ Form::file('image', array('id'=>'image')) }}	 

			</div>
		</div>
	</div>
{{ Form::close() }}

@else

{{ Form::open(['id' => 'upload', 'url' => 'image/upload', 'files' => true, 'method' => 'post','class' => 'create-form']) }}
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
					<span class="btn btn-fb">select file</span> 
					<div class="cover-up-wrap">
						<p>Click select a file to choose a image.</p>
					</div>
				</div>  	   
			    {{ Form::file('image', array('id'=>'image')) }}	 

			</div>
		</div>
	</div>
{{ Form::close() }}


@endif





