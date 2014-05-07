
    <div id='image-upload'>
        {{ Form::open(['id' => 'upload', 'url' => 'image/upload', 'files' => true, 'method' => 'post']) }}
            {{ Form::file('image', array('id'=>'image')) }}
            
        {{ Form::close() }}
    </div>