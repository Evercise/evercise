@if( basename($displayImage) != 'no-user-img.jpg')
{{ Form::open(['id' => 'upload', 'url' => 'image/upload', 'files' => true, 'method' => 'post','class' => 'create-form']) }}
	<div class="formitem clearfix">
		<div class="formlabel">

			{{ Form::label( 'image', 'Upload you user image') }}
		</div>
		<div class="formfield">
			<div class="frame" >
			  <div class="preview" >
			  	{{ HTML::image( $displayImage, $displayName.'s image', array('class'=> 'profile-pic')); }}
			  </div>
			</div>
			<div id='image-upload'>		
				<div class="cover-up">
					<span class="btn btn-fb">select file</span> 
					<div class="cover-up-wrap">
						<p>Click select a file to choose a new prolfile image.</p>
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

			{{ Form::label( 'image', 'Upload you user image') }}
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
						<p>Click select a file to choose a prolfile image.</p>
					</div>
				</div>  	   
			    {{ Form::file('image', array('id'=>'image')) }}	 

			</div>
		</div>
	</div>
{{ Form::close() }}


@endif





